

////////////////////////////////////////////////////////////////////////////////
// Modal funtions
////////////////////////////////////////////////////////////////////////////////
// Get the modal
function modalFunction(){

    var modal = document.getElementById('login-modal');
    var modal2 = document.getElementById('signup-modal');

    // Get the button that opens the modal
    var btn = document.getElementById("login");
    var btn2 = document.getElementById("signup");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    var span2 = document.getElementsByClassName("close")[1];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    btn2.onclick = function() {
        modal2.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    span2.onclick = function() {
        modal2.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal || event.target == modal2) {
            modal.style.display = "none";
            modal2.style.display = "none";
        }
    }
}


    
    
    



// jQuery UI dialog box
$( function() {
    $( "#dialog" ).dialog();
  } );
