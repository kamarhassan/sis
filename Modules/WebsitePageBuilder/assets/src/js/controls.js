
// base control object with methods including initialization
class Control {
    constructor(title, value, callback) {
        this.title = title;
        this.callback = callback;
        this.value = value;

        this.id = makeid();
    }

    groupId() {
      return 'general';
    }

    renderHtml() {
        return '<input type="file" value="" />';
    }
}

window.Control = Control;

// Function to convert hex format to a rgb color
window.rgb2hex = function(rgb) {
 rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
 return (rgb && rgb.length === 4) ? "#" +
  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
}

window.rgba2hex = function(orig) {
    var a, isPercent,
      rgb = orig.replace(/\s/g, '').match(/^rgba?\((\d+),(\d+),(\d+),?([^,\s)]+)?/i),
      alpha = (rgb && rgb[4] || "").trim(),
      hex = rgb ?
      (rgb[1] | 1 << 8).toString(16).slice(1) +
      (rgb[2] | 1 << 8).toString(16).slice(1) +
      (rgb[3] | 1 << 8).toString(16).slice(1) : orig;
  
    if (alpha !== "") {
      a = alpha;
    } else {
      a = 1;
    }
    // multiply before convert to HEX
    a = ((a * 255) | 1 << 8).toString(16).slice(1)
    hex = hex + a;
  
    return '#'+hex;
}

// get all controls
function requireAll(r) { r.keys().forEach(r); }
requireAll(require.context('./controls/', true, /\.js$/));