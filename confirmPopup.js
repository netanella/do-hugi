/*CONFIRM BOX*/
//pop up confirmation before signing up or canceling hug registration
var signup = document.getElementById('signup');
var cancel = document.getElementById('cancel');

var confirm = new customConfirm();

function customConfirm(){
    var overlay = document.getElementById('dialogoverlay');
    var box = document.getElementById('dialogbox');
    this.pop = function(message,op){
        overlay.style.display = 'block';
        box.style.display = 'block';
        document.getElementById('dialogboxhead').innerHTML = 'שים לב!';
        document.getElementById('dialogboxbody').innerHTML = message;
        document.getElementById('dialogboxfoot').innerHTML = '<button onclick="confirm.ok(\''+op+'\')">המשך</button> <button onclick="confirm.cancel(\''+op+'\')">ביטול</button>';
    }
    this.ok = function() {
        overlay.style.display = 'none';
        box.style.display = 'none';
    }
    this.cancel = function(op) {
        overlay.style.display = 'none';
        box.style.display = 'none';
        var cancel = document.getElementById('cancel');
        var signup = document.getElementById('signup');
        if (op === 'signup'){
            cancel.checked = true;
            signup.checked = false;
        }
        if (op === 'cancel'){
            cancel.checked = false;
            signup.checked = true;
        }
    }
}