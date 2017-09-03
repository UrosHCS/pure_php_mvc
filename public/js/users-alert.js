(function () {

	var div = document.createElement("div");
	console.log('stuff');
	div.style.width = "500px";
	div.style.height = "100px";
	div.style.background = "green";
	div.style.color = "white";
	div.style.opacity = 0.4;
	div.style.textAlign = "center";
	div.style.lineHeight = "100px";
	div.innerHTML = "Try resizing the window...";

	div.style.position = "absolute";
	div.style.top = "70px";
	div.style.left = "-500px";

	document.body.appendChild(div);

	var width = document.body.clientWidth;
	var step = 1;
	var pos = -500;

	var itervalId = setInterval(function() {
		pos += step;
		div.style.left = pos + 'px';
		if (pos > width) {
			clearInterval(itervalId);
			div.parentElement.removeChild(div);
		}
	}, 5);

})();