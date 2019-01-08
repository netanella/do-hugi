/*CONFIRM BOX*/
//pop up confirmation before signing up or canceling hug registration
var signup = document.getElementById('signup');
var cancel = document.getElementById('cancel');

var confirm = new CustomConfirm();

function CustomConfirm(){
    var overlay = document.getElementById('dialogoverlay');
    var box = document.getElementById('dialogbox');
    this.pop = function(message,op){
        //prevent changes before confirmation
        if(op==='signup'){
            signup.checked = false;
            cancel.checked = true;
        }
        if(op==='cancel'){
            cancel.checked = false;
            signup.checked = true;
        }
        overlay.style.display = 'block';
        box.style.display = 'block';
        document.getElementById('dialogboxhead').innerHTML = 'שים לב!';
        document.getElementById('dialogboxbody').innerHTML = message;
        document.getElementById('dialogboxfoot').innerHTML = '<button onclick="confirm.ok(\''+op+'\')">המשך</button> <button onclick="confirm.cancel(\''+op+'\')">ביטול</button>';
    }
    this.ok = function(op) {
        overlay.style.display = 'none';
        box.style.display = 'none';
        if (op === 'signup'){
            cancel.checked = false;
            signup.checked = true;
            document.forms["signupHug"].submit();
        }
        if (op === 'cancel'){
            cancel.checked = true;
            signup.checked = false;
            document.forms["signupHug"].submit();
        }
    }
    this.cancel = function() {
        overlay.style.display = 'none';
        box.style.display = 'none';
    }
}