const countryInput = document.getElementById('country-code');
const zipInput = document.getElementById('zip-code');
const zipForm = document.getElementById('zip-form');
const zipPlaces = document.getElementById('zip-places');
const errorDiv = document.getElementById('errors');
const demoZip = document.getElementById('demo-zip');
const table = document.getElementById('datatable');
const mapBTN = document.querySelector('.mapBTN');

zipForm.addEventListener('submit', handleFormSubmit);

async function handleFormSubmit(event) {
  if (event) {
    event.preventDefault();
  }
  const countryCode = countryInput.value;
  const zip = zipInput.value;
  const data = await getDataFromApi(countryCode, zip);

  if (isEmptyObject(data)) {
    clearCurrentPlaces();
    table.classList.add('d-none');
    errorDiv.classList.remove('d-none');

    return (errorDiv.innerHTML = 'Cannot find information about ZIP.');
  } else {
    table.classList.remove('d-none');
    errorDiv.classList.add('d-none');
  }

  renderZipPlaces(data.places);
}

async function getDataFromApi(countryCode, zip) {
  const response = await fetch(
    `https://api.zippopotam.us/${countryCode}/${zip}`
  );
  return response.json();
}
function renderZipPlaces(places) {
  let placesList = '';
  let index = 1;

  places.forEach((place) => {
    placesList += `
    <tr>
    <th scope="row">${index}</th>
    <td>${place.state}</td>
    <td>${place['place name']}</td>
    <td>${place['state abbreviation']}</td>
    <td>${place.latitude}</td>
    <td>${place.longitude}</td>
    <td scope="col"><button type="button" onclick="setIframe('${place.state}','${place['place name']}')" class="btn" data-bs-toggle="modal" data-type="modal" data-bs-target="#mapmodal">
    
    <i class="fa-solid fa-map-location-dot"></i>
  </button></td>
    </tr> 
    `;
    index++;
  });
  zipPlaces.innerHTML = placesList;
}
function setIframe(place, state) {
  let link =
    'https://maps.google.com/maps?z=16&output=embed&q=' + place + ',' + state;

  document.getElementById('iframe').setAttribute('src', link);
  document.getElementById('exampleModalLabel').innerHTML = state + ',' + place;
}
function clearCurrentPlaces() {
  zipPlaces.innerHTML = '';
}

function isEmptyObject(obj) {
  return Object.keys(obj).length === 0;
}

//theme color change button event
const btn = document.getElementById('theme-switch');

btn.addEventListener('click', (e) => {
  let theme = document.documentElement.getAttribute('data-bs-theme');
  if (theme == 'light' || theme == '') {
    document.documentElement.setAttribute('data-bs-theme', 'dark');
    localStorage.setItem('theme', 'dark');
  } else {
    document.documentElement.setAttribute('data-bs-theme', 'light');
  }
});

function themeColorChanged() {
  // Get the checkbox status and sun, moon select elements
  var checkBox = document.getElementById('theme-switch');

  var sun = document.getElementById('sun');
  var moon = document.getElementById('moon');

  // If the checkbox is checked, sun display none and moon display block
  if (checkBox.checked == true) {
    sun.style.display = 'none';
    moon.style.display = 'block';
  } else {
    sun.style.display = 'block';
    moon.style.display = 'none';
  }
}
