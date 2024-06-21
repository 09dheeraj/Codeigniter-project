<form id="drawingForm" class="needs-validation" action="<?php echo base_url(); ?>submit_Request_form" enctype="multipart/form-data" method="POST">
    <div class="request-painting-form">

        <div class="row">
            <div class="col-12">

                <section>
                    <nav class="nav nav-pills nav-fill justify-content-center">
                        <div class="connecting-line"></div>
                        <ul>
                            <li><a class="nav-link tab-pills" href="#">1</a></li>
                            <li> <a class="nav-link tab-pills  nav-lastchild" href="#">2</a></li>
                     
                        </ul>
                    </nav>

                    <div class="card-body">
                        <div class="tab d-none">
                            <div class="draw-section">
                                <h2>Describe your painting ideas <b>Shapes, Thoughts, <span>Visual Description</span></b></h2>
                    
                                <div class="form-group ">
                                    <label>Add a painting Title </label>
                                    <input type="text" class="form-control" placeholder="Add a title..." name="painting_title" id="paintingtitle">
                                </div>

                            
                            <div class="error-message" id="paintingtitleerror"></div>
             
                            <div class="form-group mt-4">
                                <label>Add Tag</label>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Tag1" name="tag" id="tag">
                                    </div>
                                </div>
                                <div class="error-message" id="tagError"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab d-none">
                        <div class="draw-section">
                            <div class="text-center">
                                <h2><strong>You can <span>illustrate</span> your ideas...</strong></h2>
                            </div>

                            <div class="form-group d-flex justify-content-between">
                                <label>Add a Description<span><i class="bi bi-question-circle"></i></span></label>
                                <div class="edit-section">
                                    <button id="adddiv"><i class="bi bi-plus"></i><small>ADD</small></button>
                                </div>
                            </div>

                            <div id="dataTable">
                                <div class="row align-items-center">
                                    <div class="col-12 col-lg-12 description-section">
                                        <div class="form-group d-flex">
                                            <input type="text" class="form-control" id="dataInput" placeholder="Add a description..." name="description[]">

                                          

                                        </div>
                                        <div class="error-message" id="descriptionError"></div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group pt-4">
                                <label>Draw Custom Painting<span><i class="bi bi-question-circle"></i></span></label>
                            </div>
                            <div class="draw-box d-flex profile-card m-0">
                                <div class="controls">
                                    <h3>Shape:</h3>
                                  
                                         <input type="file" id="uploader" />
                                    <div class='lightBorder'>
                                        <p><input type="radio" name="shape" value="rect"> Rectangle</p>
                                        <p><input type="radio" name="shape" value="circle"> Circle</p>
                                        <p><input type="radio" name="shape" value="square"> Square</p>
                                        <p><input type="radio" name="shape" value="ellipse"> Ellipse</p>
                                        <p><input type="radio" name="shape" value="polygon"> Polygon</p>
                                    </div>
                                    <h3>Tools:</h3>
                                    <div class='lightBorder'>
                                        <p><input type="radio" class="tool" name="shape" id="freehandbrush"  value="freehandbrush"> Brush</p>
                                        <p><input type="radio" class="tool" name="shape" value="spray"> Spray Brush</p>
                                        <p><input type="radio" class="tool" name="shape" value="sprayPaint" id="sprayPaintTool"> Spray Paint</p>
                                        

                                        <p><input type="radio" name="shape" id="freehandRadio" value="freehand"> Freehand </p>
                                        <p class="backgroundColor"><input type="radio" name="shape" id="disabledRadio" value="disabled"> Disabled </p>
                                        <p><input type="radio" name="shape" value="line"> Line</p>
                                    </div>
                                    <h3>Line Size:</h3>
                                    <div class='lightBorder'>
                                        <p><label>Line Width: <input id='lineWidth' type='range' step='1' min="1" max="200" value="4"></label></p>
                                    <div id="line-end" class="line-end" style="display:none">
                                        <h3 class="text-white">Line End:</h3>
                                        <p id="round"><input name="lineCap" id="lineCapRound" value="round" type='radio' checked="checked"> Round</p>
                                        <p id="square"><input name="lineCap" id="lineCapSquare" value="square" type='radio'> Square</p>
                                       </div>

                                    </div>
                                </div>
                                <canvas id="canvas" width="930" height="650"></canvas>

                                <div class="controls">
                                <h3>Upload image:</h3>
                                <label class="btn btn-primary mb-2" for="uploader">Insert  <i class="bi bi-card-image ps-2"></i></label>
                                <input class=" d-none" id="uploader">
                                    <h3>Colors:</h3>
                                    <div id="div"  class='lightBorder' style="display:none" >
                                        <p id="brush" style="display:none"><label>Fill Inside: <input id='fillColor' type='color' step='1' value="#24B0D5"></label></p>
                                        <p id="stroke" style="display:none"><label>Stroke : <input id='strokeColor' type='color' step='1'> </label></p>
                                        <p class="backgroundColor"><label>Background Color :<input id='backgroundColor' type='color' step='1' value="#ffffff"></label></p>

                                    </div>


                                    <!-- fill or no fill, you decide -->
                                    <div id="xordiv" class='lightBorder'  style="display:none" >
                                        <p id="fill"><label>Fill: <input id='fillBox' type='checkbox' checked='checked'></label></p>
                                        <p id="xor"><label style="font-size:12px;">XOR: <input id='xor' type='checkbox'></label></p>
                                    </div>
                                    <div id="poliSides" class='lightBorder' style="display:none">
                                        <!-- polygon sides -->
                                        <p><label>Polygon Sides : <input id='polygonSides' type='range' step='1' min="3" max="12"></label></p>
                                    </div>

                                    <div class="d-flex justify-content-end mb-3">
                                        <button class="backgroundColor" type="button" id="downloadButton">Download Image</button>
                                        <button type="button" class="button-secondary btn btn-primary" id="eraserButton" name="button">Eraser<i class="bi bi-eraser-fill ms-2"></i></button>

                                    </div>
                                    <form class="backgroundColor" style="display:none;">
                                        <h3 class="backgroundColor">Input Text:</h3> <input type="text" id="textInput" class="form-control" style="display:none;" />
                                    </form>
                                    <button type="button" class="button-error pure-button btn btn-primary" id="clearCanvas" name="button">Clear Canvas</button>
                                </div>
                            </div>
                            </div>
                        <input type="hidden" name="lineData" id="lineDataField">
                        <input type="hidden" name="IMAGEDATA" id="IMAGEDATA">



                    </div>

            </div>
            <div class="card-footer justify-content-between">
                <div class="d-flex">
                    <button type="button" id="back_button" class="btn btn-link" onclick="back()"><i class="bi bi-chevron-left"></i> Previous</button>
                    <button type="button" id="next_button" class="btn btn-primary ms-auto" onclick="next()"> <i class="bi bi-chevron-right"></i> Next </button>
                </div>
            </div>
        </div>

        </section>
    </div>
    </div>


    </div>
    </div>
    </div>
    </div>
</form>


<script src="<?php echo base_url();?>assets/css/form-step.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>

</html>

<script>
    $(document).ready(function() {
        $('#adddiv').on('click', function(event) {
            event.preventDefault();
            var clickedButtonId = this.id;
            $.ajax({
                url: "<?php echo base_url() ?>Test/appenddiv",
                type: 'post',
                success: function(response) {
                   
                    $("#dataTable").append(response); // append the new response
                }
            });
        });
    });
</script>

<script>
    $('#dataTable').on('click', '#deletebutton', function(event) {
        event.preventDefault();
        // Find the parent row and remove it
        var rows = $('#dataTable .row');
        if (rows.length > 1) {
            // Remove the parent row
            $(this).closest('.row').remove();

        }


    });
</script>


<script>
    var canvas,
        context,
        dragging = false, 
        dragStartLocation,
        snapshot;
    var lineData = [];
    console.log(lineData);

    //----------------------

    const downloadButton = document.getElementById('downloadButton');
    downloadButton.addEventListener('click', downloadCanvasImage);

    function downloadCanvasImage() {
        const canvas = document.getElementById('canvas');
        const image = canvas.toDataURL('image/png');
        const IMAGEDATA = document.getElementById('IMAGEDATA');
        $("#IMAGEDATA").val(image);
        IMAGEDATA.value = JSON.stringify(image);

    }

    //  ---------------------


    function getCanvasCoordinates(event) {
        var x = event.clientX - canvas.getBoundingClientRect().left;
        var y = event.clientY - canvas.getBoundingClientRect().top;

        return {
            x: x,
            y: y
        };
    }

    function takeSnapShot() {
        snapshot = context.getImageData(0, 0, canvas.width, canvas.height);
    }
    //These must be added to dragStart()
    function restoreSnapShot() {
        context.putImageData(snapshot, 0, 0);
    }
    var allStoredData = [];

    const lineDataField = document.getElementById('lineDataField');
    $("#lineDataField").val(lineData);
    lineDataField.value = JSON.stringify(lineData);

    var isDrawingLine = false; 

    var selectedLineCap = 'round';
    var selectedSquareCap = 'Square';

    function handleLineCapChange() {
        selectedLineCap = this.value; 
        event.stopPropagation();
    }

    document.getElementById('lineCapRound').addEventListener('change', handleLineCapChange);
    document.getElementById('lineCapSquare').addEventListener('change', handleLineCapChange);

  

    function drawLine(position) {
       
        
        var brushStyle = document.getElementById('brush');
            brushStyle.style.display = 'none';

        if (dragging && !isDrawingLine) {
            isDrawingLine = true;
            dragStartLocation = position; 
        }

        if (isDrawingLine) {
            context.clearRect(0, 0, canvas.width, canvas.height);
            restoreSnapShot();
            context.globalCompositeOperation = "source-over"; // Reset the composite operation
            context.beginPath();
            context.moveTo(dragStartLocation.x, dragStartLocation.y);
            context.lineTo(position.x, position.y);
            context.stroke();
            context.closePath();
        }

        if (!dragging && isDrawingLine) {
            isDrawingLine = false;

            var lineCapText = '';
            if (selectedLineCap === 'round') {
                lineCapText = '  Line End round ';
            } else if (selectedSquareCap === 'Square') {
                lineCapText = ' Line End Square';
            }
            for( var string=0; string<100;string++)
            {
          //  var string = 'Line Drawn with stroke Color code ' + context.strokeStyle + ' and line width ' + context.lineWidth + lineCapText;
         // var string = 'Line W -' + context.lineWidth  + ' Strok ' + context.strokeStyle + lineCapText;
          var string = 'Line W -' + context.lineWidth + lineCapText + ' Stroke ' + context.strokeStyle;
         // Line W -26  line End Square Stroke#000000  
       // ['Line W -2 Strok #000000 select Line End round ']
            lineData.push(string);
            console.log(lineData);
            const lineDataField = document.getElementById('lineDataField');
            lineDataField.value = JSON.stringify(lineData);
            }

        }

    }


    //----------------------------------------------------------------------------------------------------------------------------------------
    // circle functionality 

    var isDrawingCircle = false; // Add this variable to track if a circle is being drawn
    function drawCircle(position) {
        if (dragging && !isDrawingCircle) {
            isDrawingCircle = true;
            dragStartLocation = position; // Store the center position
        }

        if (isDrawingCircle) {
            context.clearRect(0, 0, canvas.width, canvas.height);
            restoreSnapShot();
            var radius = Math.sqrt(Math.pow((dragStartLocation.x - position.x), 2) + Math.pow((dragStartLocation.y - position.y), 2));
            context.beginPath();
            context.arc(dragStartLocation.x, dragStartLocation.y, radius, 0, 2 * Math.PI);
            context.stroke();
            context.closePath();
        }

        if (!dragging && isDrawingCircle) {
            isDrawingCircle = false;
            var radius = Math.sqrt(Math.pow((dragStartLocation.x - position.x), 2) + Math.pow((dragStartLocation.y - position.y), 2));
            var lineCapText = '';

            if (selectedLineCap === 'round') {
                lineCapText = 'select round ';
            } else if (selectedSquareCap === 'Square') {
                lineCapText = 'select Square ';

            } else {
                lineCapText = 'select Butt ';
            }
            for( var string=0; string<=100;string++)
            {
           // var string = 'circle Drawn with stroke , fill Color code' + context.strokeStyle + context.fillStyle + ' and line width ' + context.lineWidth;
           var string = 'Circle W -' + context.lineWidth  + ' Stroke ' + context.strokeStyle  + ' Fill ' + context.fillStyle;

            lineData.push(string);
            console.log(lineData);
            const lineDataField = document.getElementById('lineDataField');
            lineDataField.value = JSON.stringify(lineData);
            }
        }
    }

    //----------------------------------------------------------------------------------------------------------------------------------------
    // Ellipse  functionality 
    var isDrawingEllipse = false; // Add this variable to track if an ellipse is being drawn
    function drawEllipse(position) {
        if (dragging && !isDrawingEllipse) {
            isDrawingEllipse = true;
            dragStartLocation = position; // Store the start position
        }

        if (isDrawingEllipse) {
            context.clearRect(0, 0, canvas.width, canvas.height);
            restoreSnapShot();
            var w = position.x - dragStartLocation.x;
            var h = position.y - dragStartLocation.y;

            context.beginPath();
            var cw = (dragStartLocation.x > position.x) ? true : false;
            context.ellipse(dragStartLocation.x, dragStartLocation.y, Math.abs(w), Math.abs(h), 0, 2 * Math.PI, false);
            context.stroke();
            context.closePath();
        }

        if (!dragging && isDrawingEllipse) {
            isDrawingEllipse = false;
            var w = position.x - dragStartLocation.x;
            var h = position.y - dragStartLocation.y;
            for( var string=0; string<=100;string++)
            {

           // var string = 'ellipse Drawn with stroke , fill Color code' + context.strokeStyle + context.fillStyle + ' and line width ' + context.lineWidth;
           var string = 'Ellipse W -' + context.lineWidth  + ' Stroke ' + context.strokeStyle  + ' Fill ' + context.fillStyle;

            lineData.push(string);
            console.log(lineData);
            const lineDataField = document.getElementById('lineDataField');
            lineDataField.value = JSON.stringify(lineData);
            }

        }
    }


   var isDrawingSquare = false; // Add this variable to track if a square is being drawn
function drawSquare(position) {
    if (dragging && !isDrawingSquare) {
        isDrawingSquare = true;
        dragStartLocation = position; // Store the start position
    }

    if (isDrawingSquare) {
        context.clearRect(0, 0, canvas.width, canvas.height);
        restoreSnapShot();
        var width = position.x - dragStartLocation.x;
        var height = position.y - dragStartLocation.y;

        context.beginPath();
        context.rect(dragStartLocation.x, dragStartLocation.y, width, height);
        context.stroke();
        context.closePath();
    }

    if (!dragging && isDrawingSquare) {
        isDrawingSquare = false;
        var width = position.x - dragStartLocation.x;
        var height = position.y - dragStartLocation.y;
       // var info = 'Square Drawn with stroke , fill Color code ' + context.strokeStyle + context.fillStyle + ' and line width ' + context.lineWidth;
       var info = 'Square W -' + context.lineWidth  + ' Stroke ' + context.strokeStyle  + ' Fill ' + context.fillStyle;


         lineData.push(info);
        console.log(lineData);
        const lineDataField = document.getElementById('lineDataField');
        lineDataField.value = JSON.stringify(lineData);
    }
}



    //----------------------------------------------------------------------------------------------------------------------------------------
    // Rectangle  functionality 
    var isDrawingRect = false; // Add this variable to track if a rectangle is being drawn
    function drawRect(position) {
        if (dragging && !isDrawingRect) {
            isDrawingRect = true;
            dragStartLocation = position; // Store the start positionF
        }

        if (isDrawingRect) {
            context.clearRect(0, 0, canvas.width, canvas.height);
            restoreSnapShot();
            var w = position.x - dragStartLocation.x;
            var h = position.y - dragStartLocation.y;
            context.beginPath();
            context.rect(dragStartLocation.x, dragStartLocation.y, w, h);
            context.stroke();
            context.closePath();
        }

        if (!dragging && isDrawingRect) {
            isDrawingRect = false;
            for( var string=0; string<=100;string++)
            {
        //    var string = 'rectangle Drawn with stroke , fill color code' + context.strokeStyle + context.fillStyle + ' and line width ' + context.lineWidth;
        var string = 'Rectangle W -' + context.lineWidth  + ' Stroke ' + context.strokeStyle  + ' Fill ' + context.fillStyle;

        lineData.push(string);
            console.log(lineData);
            const lineDataField = document.getElementById('lineDataField');
            lineDataField.value = JSON.stringify(lineData);
            }

        }
    }
    //--------------------------------------------------------------------------------------------------------------------------------------
    //Brush
    const freehandbrush = document.getElementById('freehandbrush');
    freehandbrush.addEventListener('change', handlefreehandbrush);
    
    function handlefreehandbrush() {
        
        var brushStyle = document.getElementById('brush');
            brushStyle.style.display = 'none';
        
        const xorCheckbox = document.getElementById('xor');
        const fillCheckbox = document.getElementById('fillBox');
        if (freehandbrush.checked) {
            xorCheckbox.checked = false;
            fillCheckbox.checked = false;
        } else {
            xorCheckbox.checked = false;
            fillCheckbox.checked = false;
        }
    }
    //-----------------------------------------------------------------------------------------------------------------------------------------
    // free hand
    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;
    const freehandRadio = document.getElementById('freehandRadio');
    freehandRadio.addEventListener('change', startDrawingfreehand);
    const disabledRadio = document.getElementById('disabledRadio');
    freehandRadio.addEventListener('change', () => isDrawing = false);
    disabledRadio.addEventListener('change', () => isDrawing = false);


    function startDrawingfreehand(event) {

        const xorCheckbox = document.getElementById('xor');
        const fillCheckbox = document.getElementById('fillBox');
        if (freehandRadio.checked && !isDrawing) {
            xorCheckbox.checked = false;
            fillCheckbox.checked = false;
            isDrawing = true;
            const {
                offsetX,
                offsetY
            } = event;
            lastX = offsetX;
              lastY = offsetY;
            context.beginPath();

            context.moveTo(offsetX, offsetY);
            for( var string=0; string<=100;string++)
            {
            
          var string = 'Freehand W -' + context.lineWidth  + ' Stroke ' + context.strokeStyle;

          lineData.push(string);
            console.log(lineData);
            const lineDataField = document.getElementById('lineDataField');
            lineDataField.value = JSON.stringify(lineData);
            }
        }
    }

    const strokeColorInput = document.getElementById('strokeColor');
   
   strokeColorInput.addEventListener('click', handleStrokeColorChange);
   let previousStrokeColor = '';
   function handleStrokeColorChange(event) {
       
       const newStrokeColor = event.target.value; // Get the new stroke color value
       
   
       // Check if the new stroke color is different from the previous one
       if (newStrokeColor !== previousStrokeColor) {
           context.strokeStyle = newStrokeColor; // Update the stroke color
   
           
           const string = 'Freehand W - ' + context.lineWidth + ' Stroke ' + newStrokeColor;
           lineData.push(string);
   
           // Update the previousStrokeColor variable
           previousStrokeColor = newStrokeColor;
   
           // Update the lineDataField input value (if needed)
           const lineDataField = document.getElementById('lineDataField');
           lineDataField.value = JSON.stringify(lineData);
   
           // Log the updated lineData
           console.log(lineData);
       }
   }


   //---------------------------------------   spary paint  ---------------------------------------------

let sprayPaintDraw = false;
let isMousePressed = false; // Flag to track mouse button state

const sprayPaintTool = document.getElementById('sprayPaintTool');
sprayPaintTool.addEventListener('change', toggleSprayPaint);

function toggleSprayPaint(event) {
    sprayPaintDraw = sprayPaintTool.checked;
    if (sprayPaintDraw) {
        // You can add any setup code for the spray paint tool here
        alert('Spray Paint tool is active!');
    }
}

const canvass = document.getElementById('canvas');
const ctx = canvass.getContext('2d');

// Add a mousedown event listener to track when the mouse button is pressed
canvass.addEventListener('mousedown', () => {
    if (sprayPaintDraw) {
        isMousePressed = true;
    }
});

// Add a mouseup event listener to track when the mouse button is released
canvass.addEventListener('mouseup', () => {
    isMousePressed = false;
});

// Add a mousemove event listener to draw when the mouse is moved
canvass.addEventListener('mousemove', drawSprayPaint);

function drawSprayPaint(event) {
    if (sprayPaintDraw && isMousePressed) {
        const x = event.clientX - canvas.getBoundingClientRect().left;
        const y = event.clientY - canvas.getBoundingClientRect().top;

        ctx.fillStyle = document.getElementById('fillColor').value;
        ctx.beginPath();

        const brushSize = parseInt(document.getElementById('lineWidth').value);
        for (let i = 0; i < 20; i++) {
            const offsetX = (Math.random() * brushSize * 2) - brushSize;
            const offsetY = (Math.random() * brushSize * 2) - brushSize;
            ctx.arc(x + offsetX, y + offsetY, 1, 0, 2 * Math.PI);
            ctx.fill();
        }
    }
}



    //----------------------------------------------------------------------------------------------------------------------------------------
    

    function draw(position) {
        var fillBox = document.getElementById("fillBox"),
            shape = document.querySelector('input[type="radio"][name="shape"]:checked').value,
            polygonSides = document.getElementById('polygonSides').value
            ,
            polygonAngle = calculateAngle(dragStartLocation, position),
            lineCap = document.querySelector('input[type="radio"][name="lineCap"]:checked').value,
            writeCanvas = document.getElementById('textInput').value,
            xor = document.getElementById('xor');
        //global context
        context.lineCap = lineCap;

        //we don't need even't handlers because before drawing we are jsut taking a default value
        if (shape === "spray") {
            drawSpray(position);
        }

        if (shape === "circle") {
            drawCircle(position);
        }
        if (shape === "square") {
            drawSquare(position);
        }
        if (shape === "line") {
           
            drawLine(position);
        }
        if (shape === "ellipse") {
            drawEllipse(position);
        }
        if (shape === "rect") {
            drawRect(position);
        }
        if (shape === "freehand") {
            startDrawingfreehand(event);
        }
        if (shape === "freehandbrush") {
            handlefreehandbrush(event);
        }

        if (shape === "polygon") {
            drawPolygon(position, polygonSides, polygonAngle * (Math.PI / 180));
        }
        if (xor.checked) {
            context.globalCompositeOperation = "xor";
        } else {
            context.globalCompositeOperation = "source-over";
        }
        if (fillBox.checked) {
            context.fill();
        } else {
            context.stroke();
        }

       
    }






    // Polygon  functionality 
    var isDrawingPolygon = false;


    function drawPolygon(position, sides, angle) {

        if (dragging && !isDrawingPolygon) {
            isDrawingPolygon = true;
            dragStartLocation = position;
        }

        if (isDrawingPolygon) {
            context.clearRect(0, 0, canvas.width, canvas.height);
            restoreSnapShot();
            var coordinates = [],
                radius = Math.sqrt(Math.pow((dragStartLocation.x - position.x), 2) + Math.pow((dragStartLocation.y - position.y), 2)),
                index = 0;

            for (index; index < sides; index++) {
                coordinates.push({
                    x: dragStartLocation.x + radius * Math.cos(angle),
                    y: dragStartLocation.y - radius * Math.sin(angle)
                })
                angle += (2 * Math.PI) / sides;
            }

            context.beginPath();
            context.moveTo(coordinates[0].x, coordinates[0].y);

            for (index = 0; index < sides; index++) {
                context.lineTo(coordinates[index].x, coordinates[index].y);
            }

            context.closePath();
            context.stroke();
        }

        if (!dragging && isDrawingPolygon) {
            isDrawingPolygon = false;

            var polygonSidesValue = polygonSides;
           var polygon_sidesval = polygonSidesValue.value;
           for( var string=0; string<=100;string++)
            {
        //   var string = 'Polygon Drawn with stroke , fill color code' + context.strokeStyle + context.fillStyle + 'line width sides ' + context.lineWidth + '-' + polygon_sidesval;
        var string = ' Polygon W - ' + context.lineWidth +  ' Sides ' +  polygon_sidesval  +  ' Stroke ' + context.strokeStyle  + ' Fill ' + context.fillStyle;

        lineData.push(string);
            console.log(lineData);
            const lineDataField = document.getElementById('lineDataField');
            lineDataField.value = JSON.stringify(lineData);
            }
        }
    }

    function displayDrawnShapes() {
        console.log("Drawn Shapes Order:");
        for (const shape of drawnShapes) {
        }
    }

    //define dragstart, drag and dragStop
    function dragStart(event) {
        dragging = true;
        dragStartLocation = getCanvasCoordinates(event);
        takeSnapShot();
    }

    function calculateAngle(start, current) {

        var angle = 360 - Math.atan2(current.y - start.y, current.x - start.x) * 180 / Math.PI;


        return angle;
    }

    function drag(event) {
        var position;
        if (dragging === true) {
            restoreSnapShot();
            position = getCanvasCoordinates(event);
            //generic
            draw(position);
        }
    }

    //Drag Stop
    function dragStop(event) {
        dragging = false; //dragging stops here
        restoreSnapShot();
        var position = getCanvasCoordinates(event);
        //generic
        draw(position);
    }

    //Line Width Here
 
    //Fill Color
    function changeFillStyle() {
        context.fillStyle = this.value;
        event.stopPropagation();

        var string = 'troke Color code and fill color code ' + context.strokeStyle;
    }
    //Stroke Color
    function changeStrokeStyle() {
        context.strokeStyle = this.value;
        console.log(lineData);
        event.stopPropagation();
    }

    //backgroundColor
    function changeBackgroundColor() {
        context.save();
        context.fillStyle = document.getElementById('backgroundColor').value;
        context.fillRect(0, 0, canvas.width, canvas.height);
        context.restore();
    }

    function eraseCanvas() {
        context.clearRect(0, 0, canvas.width, canvas.height);
    }

    function writeCanvas() {
        textX = 25;
        textY = 175;
        context.font = '55px Impact';
        context.fillText(textInput.value, textX, textY);
        event.preventDefault(); // Add this line to prevent color filling
        redrawCanvas(); // Redraw the canvas to update the text position
    }

    function redrawCanvas() {
        context.clearRect(0, 0, canvas.width, canvas.height);

        // Redraw other elements (shapes, lines, etc.)
        context.font = '18px Arial';
        context.fillText(textInput.value, textX, textY);
    }

    //------------------------------------------------------------------------------------------------------------------------------------------
    //  Eraser functionality
    let erasing = false;
    const eraserButton = document.getElementById("eraserButton");
    eraserButton.addEventListener("click", toggleEraser);
    //-----------------------------------------------------------------------------------------------------------------------------------------
    // When eraser clicked all radio button will unchecked
    eraserButton.addEventListener("click", function () {
  // Uncheck all radio buttons for drawing shapes
  const shapeRadioButtons = document.querySelectorAll('input[type="radio"][name="shape"]');
  shapeRadioButtons.forEach((radio) => {
    radio.checked = false;
  });
   const sprayBrushCheckbox = document.getElementById("freehandbrush");
  sprayBrushCheckbox.checked = false;

});

//-------------------------------------------------------------------------------------------------------------------------------------------------




    function toggleEraser() {
        erasing = !erasing;
        if (erasing) {
            context.globalCompositeOperation = "destination-out";
        } else {
            context.globalCompositeOperation = "source-over";
        }
    }
    ERASER_WIDTH = 2000;

    function dragStart(event) {
        dragging = true;
        dragStartLocation = getCanvasCoordinates(event);
        takeSnapShot();

        if (erasing) {
            context.beginPath();
            context.arc(
                dragStartLocation.x,
                dragStartLocation.y,
                ERASER_WIDTH / 2, // Use half of the width for radius
                0,
                Math.PI * 2
            );
            context.fill(); // Fill the circle to erase
        }
    }


    function drag(event) {
        var position;
        if (dragging === true) {
            restoreSnapShot();
            position = getCanvasCoordinates(event);

            if (erasing) {

                context.lineTo(position.x, position.y);
                context.stroke();
                dragStartLocation = position;
            } else {
                // Your regular drawing code here
                draw(position);
            }
        }
    }
    function dragStop(event) {
        dragging = false;
        restoreSnapShot();
        var position = getCanvasCoordinates(event);

        if (erasing) {
            context.lineTo(position.x, position.y);
            context.stroke();
            context.closePath();
            var string = 'Eraser Used';
            lineData.push(string);
            console.log(lineData);
            const lineDataField = document.getElementById('lineDataField');
            lineDataField.value = JSON.stringify(lineData);
        } else {
            // Your regular drawing code here
            draw(position);
        }
    }
    //-------------------------------------------------------------------------------------------------------------
    // Disable the eraser in spray

    const toolButtons = document.querySelectorAll('.tool');
    toolButtons.forEach(button => {
        button.addEventListener('click', () => {
            const xorCheckbox = document.getElementById('xor');
            const fillCheckbox = document.getElementById('fillBox');
            xorCheckbox.checked = false; // Uncheck XOR checkbox
            fillCheckbox.checked = true; // Check Fill checkbox
            isDrawingSpray = button.value === 'spray';
            erasing = false; // Disable eraser mode
            context.globalCompositeOperation = "source-over"; // Reset the composite operation
        });
    });

    //-------------------------------------------------------------------------------------------------------------
    // Disable the eraser in line

    const lineButton = document.querySelector('input[type="radio"][name="shape"][value="line"]');
    lineButton.addEventListener('click', () => {
        const xorCheckbox = document.getElementById('xor');
        const fillCheckbox = document.getElementById('fillBox');
        xorCheckbox.checked = false; // Uncheck XOR checkbox
        fillCheckbox.checked = true; // Check Fill checkbox
        isDrawingLine = true;
        isDrawingSpray = false; // Disable spray brush mode
        erasing = false; // Disable eraser mode
        context.globalCompositeOperation = "source-over"; // Reset the composite operation
    });
    //-------------------------------------------------------------------------------------------------------------
    // Disable the eraser in circle
    const circleButton = document.querySelector('input[type="radio"][name="shape"][value="circle"]');
    circleButton.addEventListener('click', () => {
        const xorCheckbox = document.getElementById('xor');
        const fillCheckbox = document.getElementById('fillBox');
        xorCheckbox.checked = false; // Uncheck XOR checkbox
        fillCheckbox.checked = true; // Check Fill checkbox
        isDrawingSpray = false; // Disable spray brush mode
        erasing = false; // Disable eraser mode
        context.globalCompositeOperation = "source-over"; // Reset the composite operation
    });
    //-------------------------------------------------------------------------------------------------------------
    // Disable the eraser in rectangle

    const rectButton = document.querySelector('input[type="radio"][name="shape"][value="rect"]');
    rectButton.addEventListener('click', () => {
        const xorCheckbox = document.getElementById('xor');
        const fillCheckbox = document.getElementById('fillBox');
        xorCheckbox.checked = false; // Uncheck XOR checkbox
        fillCheckbox.checked = true; // Check Fill checkbox
        isDrawingSpray = false; // Disable spray brush mode
        erasing = false; // Disable eraser mode
        context.globalCompositeOperation = "source-over"; // Reset the composite operation
    });
    //-------------------------------------------------------------------------------------------------------------
    // Disable the eraser in ellipse

    const ellipseButton = document.querySelector('input[type="radio"][name="shape"][value="ellipse"]');
    ellipseButton.addEventListener('click', () => {
        const xorCheckbox = document.getElementById('xor');
        const fillCheckbox = document.getElementById('fillBox');
        xorCheckbox.checked = false; // Uncheck XOR checkbox
        fillCheckbox.checked = true; // Check Fill checkbox
        isDrawingSpray = false; // Disable spray brush mode
        erasing = false; // Disable eraser mode
        context.globalCompositeOperation = "source-over"; // Reset the composite operation
    });
    //-------------------------------------------------------------------------------------------------------------
    // Disable the eraser in polygon

    const polygonButton = document.querySelector('input[type="radio"][name="shape"][value="polygon"]');
    polygonButton.addEventListener('click', () => {
        const xorCheckbox = document.getElementById('xor');
        const fillCheckbox = document.getElementById('fillBox');
        xorCheckbox.checked = false; // Uncheck XOR checkbox
        fillCheckbox.checked = true; // Check Fill checkbox
        isDrawingSpray = false; // Disable spray brush mode
        erasing = false; // Disable eraser mode
        context.globalCompositeOperation = "source-over"; // Reset the composite operation
    });

    //---------------------------------------------------------------------------------------------------------
    // <input type="radio" name="shape" id="freehandRadio" value="freehand"> 
    const freehand = document.querySelector('input[type="radio"][name="shape"][value="freehand"]');
    freehand.addEventListener('click', () => {
        const xorCheckbox = document.getElementById('xor');
        const fillCheckbox = document.getElementById('fillBox');
        xorCheckbox.checked = false; // Uncheck XOR checkbox
        fillCheckbox.checked = true; // Check Fill checkbox
        isDrawingSpray = false; // Disable spray brush mode
        erasing = false; // Disable eraser mode
        context.globalCompositeOperation = "source-over"; // Reset the composite operation
    });

    //---------------------------------------------------------------------------------------------------
    // Spray button functionality

    var isDrawingSpray = false; // Add this variable to track if spray brush is active
    var sprayBrushUsed = false;

    function changeLineWidth() {
        context.lineWidth = this.value;
        event.stopPropagation();
    }

    function drawSpray(position) {
        if (isDrawingSpray) {
            const numParticles = 70; // Increase the number of particles
            const sprayRadius = 20; // Adjust the spray radius

            for (let i = 0; i < numParticles; i++) {
                const angle = Math.random() * Math.PI * 2; // Randomize angle
                const distance = Math.random() * sprayRadius; // Randomize distance within the spray radius
                const offsetX = Math.cos(angle) * distance;
                const offsetY = Math.sin(angle) * distance;
                const x = position.x + offsetX;
                const y = position.y + offsetY;

                context.beginPath();
                context.arc(x, y, Math.random() * 2, 0, Math.PI * 2);
                context.fill();
                context.closePath();
                if (isDrawingSpray && !sprayBrushUsed) {
                    if (i === numParticles - 1) { // Push data only once at the end of the loop
                        sprayBrushUsed = true; // Set the variable to true
                      //  var string = 'Spray brush Drawn with fill Color code ' + context.fillStyle + ' and line width ' + context.lineWidth;
                      var string = ' Spray brush W - ' + context.lineWidth + ' Fill ' + context.fillStyle;

                        lineData.push(string);
                        console.log(lineData);
                        const lineDataField = document.getElementById('lineDataField');
                        lineDataField.value = JSON.stringify(lineData);
                    }
                }
            }

        }
    }





    //--------------------------------------------------------------------------------------------------------------------------------------------------------------
    //Drag text
    let isDraggingText = false;
    let textX = 100; // Initial x-coordinate of the text
    let textY = 100; // Initial y-coordinate of the text
    let offsetX = 0;
    let offsetY = 0;

    function startDraggingText(event) {
        const mouseX = event.clientX - canvas.getBoundingClientRect().left;
        const mouseY = event.clientY - canvas.getBoundingClientRect().top;

        if (
            mouseX > textX &&
            mouseX < textX + context.measureText(textInput.value).width &&
            mouseY > textY - 30 && // Adjust for text height
            mouseY < textY
        ) {
            isDraggingText = true;
            offsetX = mouseX - textX;
            offsetY = mouseY - textY;
        }
    }

    function dragText(event) {
        if (isDraggingText) {
            const mouseX = event.clientX - canvas.getBoundingClientRect().left;
            const mouseY = event.clientY - canvas.getBoundingClientRect().top;

            textX = mouseX - offsetX;
            textY = mouseY - offsetY;

            redrawCanvas(); // Call a function to redraw the canvas including the text
        }
    }

    function stopDraggingText() {
        isDraggingText = false;
    }
    const clearCanvasButton = document.getElementById('clearCanvas');


clearCanvasButton.addEventListener('click', function() {
   
    var string = 'Canvas Cleared'; 
    lineData.push(string);
    console.log(lineData);

    // // Update the lineDataField input value (if needed)
    const lineDataField = document.getElementById('lineDataField');
    lineDataField.value = JSON.stringify(lineData);
});
    

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------
    //function invoked when document is fully loaded
    function init() {
        canvas = document.getElementById('canvas');
        context = canvas.getContext('2d');
        //-------------------------------------------------------
        //Image upload in canvas
        const reader = new FileReader();
        const img = new Image();
    const uploadImage = (e) => {
                reader.onload = () => {
                    const img = new Image();
                    img.onload = () => {
                        // canvas.width = img.width;   // Set canvas width to match image width
                        // canvas.height = img.height; // Set canvas height to match image height
                        context.drawImage(img, 0, 0);
                    };
                    img.src = reader.result;
                };
                reader.readAsDataURL(e.target.files[0]);
            };

        //-------------------------------------------------------

         var lineWidth = document.getElementById('lineWidth'),
            fillColor = document.getElementById('fillColor'),
            strokeColor = document.getElementById('strokeColor'),
            canvasColor = document.getElementById('backgroundColor'),
            clearCanvas = document.getElementById('clearCanvas'),
            textInput = document.getElementById('textInput');

        context.lineWidth = 2;
        context.fillStyle = fillColor.value;

        //Event listeners below
        canvas.addEventListener('mousedown', dragStart, false);
        canvas.addEventListener('mousemove', drag, false);
        canvas.addEventListener('mouseup', dragStop, false);
        lineWidth.addEventListener('input', changeLineWidth, false);
        fillColor.addEventListener('input', changeFillStyle, false);
        strokeColor.addEventListener('input', changeStrokeStyle, false);
        canvasColor.addEventListener('input', changeBackgroundColor, false);

        clearCanvas.addEventListener('click', eraseCanvas, false);
        textInput.addEventListener('input', writeCanvas, false);
        const eraserButton = document.getElementById("eraserButton");
         eraserButton.addEventListener("click", toggleEraser);
     
           const freehandbrush = document.querySelector('input[type="radio"][name="shape"][value="freehandbrush"]');
           freehandbrush.addEventListener('click', () => {
            isDrawingSpray = true;
            erasing = false; // Disable eraser mode
            });
        let isDrawing = false;
        let lastX = 0;
        let lastY = 0;

        canvas.addEventListener('mousedown', (event) => {
            isDrawing = true;
            lastX = event.offsetX;
            lastY = event.offsetY;
            context.beginPath(); // Start a new drawing path
            context.moveTo(lastX, lastY); // Move to the initial position
        });

        // Event listener for when the mouse is moved
        canvas.addEventListener('mousemove', (event) => {
            if (!isDrawing) return;
            const currentX = event.offsetX;
            const currentY = event.offsetY;

            context.lineTo(currentX, currentY); // Draw a line from lastX,lastY to currentX,currentY
            context.stroke(); // Apply stroke to the drawn line

            // Update lastX and lastY
            lastX = currentX;
            lastY = currentY;
        });

        // Event listener for when the mouse button is released
        canvas.addEventListener('mouseup', () => {
            isDrawing = false;
            context.closePath(); // End the drawing path
        });


        //const textInput = document.getElementById('textInput');
        textInput.addEventListener('input', () => {
            redrawCanvas(); // Call a function to redraw the canvas including the text
        });
        canvas.addEventListener("mousedown", startDraggingText);
        canvas.addEventListener("mousemove", dragText);
        canvas.addEventListener("mouseup", () => {
            isDraggingText = false;
        });

        //----------------------------------------------------------
        //Image upload
        const imageLoader = document.getElementById("uploader");
          imageLoader.addEventListener("change", uploadImage);
    }


    window.addEventListener('load', init, false);
</script>
<script>
jQuery(document).ready(function(){
$('input:radio[name="shape"]').change(function(){
    if($(this).val() == 'freehandbrush'){
        
        var brushStyle = document.getElementById('stroke');
            brushStyle.style.display = 'block';
            var brushStyle = document.getElementById('div');
            brushStyle.style.display = 'block';
            var ploysideStyle = document.getElementById('poliSides');
            ploysideStyle.style.display = 'none';
             var ploysideStyle = document.getElementById('xor');
             ploysideStyle.style.display = 'none';
             var ploysideStyle = document.getElementById('fill');
             ploysideStyle.style.display = 'none';
             var ploysideStyle = document.getElementById('line-end');
             ploysideStyle.style.display = 'none';
             var ploysideStyle = document.getElementById('xordiv');
             ploysideStyle.style.display = 'none';

      
    }
    else if($(this).val() == 'freehand'){
        var ploysideStyle = document.getElementById('xordiv');
             ploysideStyle.style.display = 'none';
        var brushStyle = document.getElementById('stroke');
            brushStyle.style.display = 'block';
            var brushStyle = document.getElementById('div');
            brushStyle.style.display = 'block';
            var brushStyle = document.getElementById('brush');
            brushStyle.style.display = 'none';
            var ploysideStyle = document.getElementById('fill');
             ploysideStyle.style.display = 'none';
            

            var ploysideStyle = document.getElementById('poliSides');
            ploysideStyle.style.display = 'none';
            var ploysideStyle = document.getElementById('xor');
             ploysideStyle.style.display = 'none';
             var ploysideStyle = document.getElementById('line-end');
             ploysideStyle.style.display = 'none';
      
    }
    else if($(this).val() == 'line'){
        var brushStyle = document.getElementById('div');
            brushStyle.style.display = 'block';
        var ploysideStyle = document.getElementById('xordiv');
             ploysideStyle.style.display = 'none';
        var brushStyle = document.getElementById('stroke');
            brushStyle.style.display = 'block';
            var brushStyle = document.getElementById('brush');
            brushStyle.style.display = 'none';
            var brushStyle = document.getElementById('fill');
            brushStyle.style.display = 'none';
            var ploysideStyle = document.getElementById('poliSides');
            ploysideStyle.style.display = 'none';
            var ploysideStyle = document.getElementById('xor');
             ploysideStyle.style.display = 'none';
             var ploysideStyle = document.getElementById('line-end');
             ploysideStyle.style.display = 'block';
             var ploysideStyle = document.getElementById('fill');
             ploysideStyle.style.display = 'none';
      
    }
    else if($(this).val() == 'rect'){
        var ploysideStyle = document.getElementById('xordiv');
             ploysideStyle.style.display = 'block';
        var brushStyle = document.getElementById('brush');
            brushStyle.style.display = 'block';
            var brushStyle = document.getElementById('div');
            brushStyle.style.display = 'block';
            var brushStyle = document.getElementById('stroke');
            brushStyle.style.display = 'block';

            var ploysideStyle = document.getElementById('poliSides');
            ploysideStyle.style.display = 'none';
            var ploysideStyle = document.getElementById('line-end');
             ploysideStyle.style.display = 'none';
             var ploysideStyle = document.getElementById('xor');
             ploysideStyle.style.display = 'none';
             var ploysideStyle = document.getElementById('fill');
             ploysideStyle.style.display = 'block';
      
    }
    else if($(this).val() == 'circle'){
        var ploysideStyle = document.getElementById('xordiv');
             ploysideStyle.style.display = 'block';
        var brushStyle = document.getElementById('div');
            brushStyle.style.display = 'block';
        var brushStyle = document.getElementById('brush');
            brushStyle.style.display = 'block';
            var brushStyle = document.getElementById('stroke');
            brushStyle.style.display = 'block';
            var ploysideStyle = document.getElementById('poliSides');
            ploysideStyle.style.display = 'none';
            var ploysideStyle = document.getElementById('line-end');
             ploysideStyle.style.display = 'none';
             var ploysideStyle = document.getElementById('xor');
             ploysideStyle.style.display = 'none';
             var ploysideStyle = document.getElementById('fill');
             ploysideStyle.style.display = 'block';
      
    }
    else if($(this).val() == 'square'){
        var ploysideStyle = document.getElementById('xordiv');
             ploysideStyle.style.display = 'block';
        var brushStyle = document.getElementById('div');
            brushStyle.style.display = 'block';
           var brush = document.getElementById('brush');
            brush.style.display = 'block';
            var stroke = document.getElementById('stroke');
            stroke.style.display = 'block';
            var ploysideStyle = document.getElementById('poliSides');
            ploysideStyle.style.display = 'none';
            var lineend = document.getElementById('line-end');
            lineend.style.display = 'none';
             var xor = document.getElementById('xor');
             xor.style.display = 'none';
             var ploysideStyle = document.getElementById('fill');
             ploysideStyle.style.display = 'block';
      
    }
    else if($(this).val() == 'ellipse'){
        var ploysideStyle = document.getElementById('xordiv');
             ploysideStyle.style.display = 'block';
        var brushStyle = document.getElementById('div');
            brushStyle.style.display = 'block';
        var brushStyle = document.getElementById('brush');
            brushStyle.style.display = 'block';
            var brushStyle = document.getElementById('stroke');
            brushStyle.style.display = 'block';
            var ploysideStyle = document.getElementById('poliSides');
            ploysideStyle.style.display = 'none';
            var ploysideStyle = document.getElementById('line-end');
             ploysideStyle.style.display = 'none';
             var ploysideStyle = document.getElementById('xor');
             ploysideStyle.style.display = 'none';
             var ploysideStyle = document.getElementById('fill');
             ploysideStyle.style.display = 'block';
      
    }
    
    
    else if($(this).val() == 'polygon'){
        var ploysideStyle = document.getElementById('xordiv');
             ploysideStyle.style.display = 'block';
        var brushStyle = document.getElementById('div');
            brushStyle.style.display = 'block';
        var brushStyle = document.getElementById('poliSides');
            brushStyle.style.display = 'block';
            var brushStyle = document.getElementById('stroke');
            brushStyle.style.display = 'block';
            var brushStyle = document.getElementById('brush');
            brushStyle.style.display = 'block';
            var ploysideStyle = document.getElementById('line-end');
             ploysideStyle.style.display = 'none';
              var ploysideStyle = document.getElementById('xor');
             ploysideStyle.style.display = 'none';
             var ploysideStyle = document.getElementById('fill');
             ploysideStyle.style.display = 'block';
      
    }
    
  
    else if($(this).val() == 'spray'){

        var brushStyle = document.getElementById('div');
            brushStyle.style.display = 'block';
            var ploysideStyle = document.getElementById('stroke');
            ploysideStyle.style.display = 'none';
            var brushStyle = document.getElementById('brush');
            brushStyle.style.display = 'block';
            var ploysideStyle = document.getElementById('fill');
             ploysideStyle.style.display = 'block';
        
      
    }

});
});
</script>








    <script>

        $(document).on('blur','#dataInput', function () {  
            thisValue = $(this).val();
             var check = 'PB2023' ; 
            var imploddata =  thisValue.split(/[,]+/).filter(function(v){return v!==''}).join('~')
            var data = check + imploddata ;         

            lineData.push(data);
            console.log(lineData);  
        });
    




    
</script>

<!-- <script>
    $(document).ready(function() {
        $("#Contact_form").validate({
            rules: {
                cust_name: {
                    required: true
                },
                cust_email: {
                    required: true,
                    email: true
                }


            },
            messages: {
                cust_name: {
                    required: "Name is required"
                },
                cust_email: {
                    required: "Email is required",
                    email: "Please enter a valid email address"
                }
            }
        });
    });
</script> -->
