var shapeStartX, shapeStartY;
var tempShapeX, tempShapeY, tempShapeW, tempShapeH = null;
var house;
var selected, rooms = [];

function setup() {
    createCanvas(windowWidth / 1.5, windowHeight - 50);

    radio = createRadio();
    radio.option('house');
    radio.option('wall')
    radio.option('select');
    radio.style('height', '60px');

    background(0);
}

function draw() {
    background(0);

    (house != null) ? house.show() : null;

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
    if(radio.value() == 'house'){
        shapeStartX = mouseX;
        shapeStartY = mouseY;
    }
}

function mouseClicked(){
    if(radio.value() == 'select'){
        house.houseSelected();
    }else if(radio.value() == 'wall'){
        house.wallSelected();
    }
}

function mouseMoved(){
    if(radio.value() == 'wall'){
        house.wallHover();
    }
}

function mouseDragged(){
    if(radio.value() == 'house'){
        tempShapeX= Math.min(shapeStartX, mouseX);
        tempShapeY = Math.min(shapeStartY, mouseY);
        var xend = Math.max(shapeStartX, mouseX);
        var yend = Math.max(shapeStartY, mouseY);

        tempShapeW = abs(xend - tempShapeX);
        tempShapeH = abs(yend - tempShapeY);
    }
}

function mouseReleased(){
    if(radio.value() == 'house' && mouseX < width && mouseY < height){
        this.house = new House(tempShapeX, tempShapeY, tempShapeW, tempShapeH);
    }

    tempShapeX, tempShapeY, tempShapeW, tempShapeH = null;
}

function windowResized(){
    resizeCanvas(windowWidth / 1.5, windowHeight - 50);
}
