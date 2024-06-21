</div>
 
    </div>
</div>









<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> 


<script src="<?php echo base_url(); ?>assets/css/form-step.js"></script>

<script>
function autoType(elementClass, typingSpeed, timeout) {
    var ourClass = $(elementClass);
    ourClass.css({
      "position": "relative",
      "display": "inline-block"
    });
    ourClass = ourClass.find(".text-js");
    var text = ourClass.text().trim().split('');
    var amntOfChars = text.length;
    var newString = "";
    
    setTimeout(function () {
      ourClass.css("opacity", 1);
      ourClass.text("");
      for (var i = 0; i < amntOfChars; i++) {
        (function (i, char) {
          setTimeout(function () {
            newString += char;
            ourClass.text(newString);
          }, i * typingSpeed);
        })(i, text[i]);
      }
    }, timeout);
  }

function fire(){
    autoType(".type-js", 50, 1000);   
}
</script>

  
         </body>
         </html> 