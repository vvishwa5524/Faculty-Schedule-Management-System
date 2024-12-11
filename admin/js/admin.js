const osmLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
const osmUrl = "http://tile.openstreetmap.org/{z}/{x}/{y}.png";
const osmAttrib = `&copy; ${osmLink} Contributors`;

const osmMap = L.tileLayer(osmUrl, { attribution: osmAttrib });

let config = {
	layers: [osmMap],
  minZoom: 7,
  maxZoom: 18,
  fullscreenControl: true,
};

const zoom = 10;
const lat = -39.267;
const lng = -71.967;

const map = L.map("map", config).setView([lat, lng], zoom);

setTimeout(function () {
	map.invalidateSize();
}, 100);

L.control
  .scale({
    imperial: false,
  })
  .addTo(map);

L.marker([-39.267, -71.967]).addTo(map).bindPopup("Hola Pucon");

const style = document.createElement("style");
style.textContent = `.leaflet-tile-container { filter: grayscale(1)}`;
document.head.appendChild(style);

var chart = document.getElementById("chart").getContext("2d"),
	gradient = chart.createLinearGradient(0, 0, 0, 450);

var data = {
	labels: [
		"Ene",
		"Feb",
		"Mar",
		"Abr",
		"May",
		"Jun",
		"Jul",
		"Ago",
		"Sep",
		"Oct",
		"Nov",
		"Dec"
	],
	datasets: [
		{
			label: "Flow",
			data: [4.5, 4.5, 5, 6, 4, 5.5, 5.5, 6, 4.5, 4, 4, 5.5],
			lineTension: 0,
			fill: true,
			borderColor: "#3b82f6",
			backgroundColor: "transparent"
		},
		{
			label: "Pressure",
			lineTension: 0,
			data: [60, 45, 80, 30, 35, 55, 25, 80, 40, 50, 80, 50],
			fill: true,
			borderColor: "#ef4444",
			backgroundColor: "transparent"
		}
	]
};

var options = {
	responsive: true,
	legend: {
		display: true,
		position: "top",
	}
};

var chartInstance = new Chart(chart, {
	type: "line",
	data: data,
	options: options
});
