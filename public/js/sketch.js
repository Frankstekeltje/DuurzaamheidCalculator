var shapeStartX, shapeStartY;
var tempShapeX, tempShapeY, tempShapeW, tempShapeH = null;
var rooms = [];
var selected = [];

function setup() {
    createCanvas(windowWidth / 1.5, windowHeight - 50);

    radio = createRadio();
    radio.option('room');
    radio.option('select');
    radio.style('height', '60px');

    background(0);
}

function draw() {
    background(0);

    for(var i = 0; i < rooms.length; i++){
        rooms[i].show();
    }

    if(tempShapeX != null){
        push();
        fill(255);
        rect(tempShapeX, tempShapeY, tempShapeW, tempShapeH);
        pop();
    }
}

function mousePressed(){
    if(radio.value() == 'room'){
        shapeStartX = mouseX;
        shapeStartY = mouseY;
    }
}

function mouseClicked(){
    console.log(rooms.length);
    if(radio.value() == 'select'){
        for(var i = 0; i < rooms.length; i++){
            rooms[i].roomSelected(mouseX, mouseY);
        }
    }
}

function mouseDragged(){
    if(radio.value() == 'room'){
        tempShapeX= Math.min(shapeStartX, mouseX);
        tempShapeY = Math.min(shapeStartY, mouseY);
        var xend = Math.max(shapeStartX, mouseX);
        var yend = Math.max(shapeStartY, mouseY);

        tempShapeW = abs(xend - tempShapeX);
        tempShapeH = abs(yend - tempShapeY);
    }
}

function mouseReleased(){
    if(radio.value() == 'room' && mouseX < width && mouseY < height){
        rooms.push(new Room(tempShapeX, tempShapeY, tempShapeW, tempShapeH));
    }

    tempShapeX, tempShapeY, tempShapeW, tempShapeH = null;
}

function windowResized(){
    resizeCanvas(windowWidth / 1.5, windowHeight - 50);
}
