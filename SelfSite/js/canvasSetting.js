$(document).ready(function() {
  if(!$('#myCanvas').tagcanvas({
    outlineColour: null,
    reverse: true,
    depth: 0.8,
    maxSpeed: 0.05,
    textHeight: '25',
    textColour: '#fff',
  },'tags')) {
    $('#myCanvasContainer').hide();
  }
});