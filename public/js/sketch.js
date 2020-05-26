var shapeStartX, shapeStartY;
var tempShapeX, tempShapeY, tempShapeW, tempShapeH = null;
var house;
var selectedWall, selectedRoom = null;
var selectedWallArray, roomBoundaries;
var walls = [];
var rooms = [];

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

    if(this.tempShapeX != null && radio.value() == 'house'){
        push();
        fill(255);
        rect(this.tempShapeX, this.tempShapeY, this.tempShapeW, this.tempShapeH);
        pop();
    }else if(this.tempShapeX != null && radio.value() == 'wall' && this.selectedWall != null){
        push();
        strokeWeight(5);
        stroke(125);
        line(this.tempShapeX, this.tempShapeY, this.tempShapeW, this.tempShapeH);
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
    }else if(radio.value() == 'wall' && this.selectedWall == null){
        this.selectedWallArray = house.wallSelected();
        if(Array.isArray(this.selectedWallArray)){
            this.selectedWall = this.selectedWallArray[0];
            this.roomBoundaries = this.selectedWallArray[1];
            tempWallCreation();
        }else{
            this.selectedWall = null;
            this.roomBoundaries = null;
        }
    }else if(radio.value() == 'wall' && this.selectedWall != null){
        wallCreation();
    }
}

function mouseMoved(){
    if(radio.value() == 'wall' && this.selectedWall == null){
        house.wallHover();
    }else if(radio.value() == 'wall' && this.selectedWall != null){
        tempWallCreation();
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
        tempShapeX, tempShapeY, tempShapeW, tempShapeH = null;
    }else if(radio.value() == 'house'){
        tempShapeX, tempShapeY, tempShapeW, tempShapeH = null;
    }
}

function windowResized(){
    resizeCanvas(windowWidth / 1.5, windowHeight - 50);
}

function tempWallCreation(){
    if(checkBoundaries()){
        if(this.selectedWall.type == "horizontal"){
            this.tempShapeX = mouseX
            this.tempShapeW = mouseX;
            this.tempShapeY = this.selectedWall.y1;
            this.tempShapeH = mouseY;
        }else if(this.selectedWall.type == "vertical"){
            this.tempShapeY = mouseY;
            this.tempShapeH = mouseY;
            this.tempShapeX = this.selectedWall.x1;
            this.tempShapeW = mouseX;
        }
    }
}

function checkBoundaries(){
    return mouseX < (roomBoundaries.x + roomBoundaries.w ) && mouseX > roomBoundaries.x && mouseY < (roomBoundaries.y + roomBoundaries.h) && mouseY > roomBoundaries.y
}

function wallCreation(){
    this.selectedWallArray = house.wallSelected();
    if(Array.isArray(this.selectedWallArray)){
        if(this.selectedWallArray[0].type == "vertical" && this.selectedWallArray[0].type == this.selectedWall.type){
            var calcVar = abs(this.roomBoundaries.y + this.roomBoundaries.h - mouseY);
            this.house.alterRoom(this.roomBoundaries, this.roomBoundaries.x, this.roomBoundaries.y, this.roomBoundaries.w, mouseY - this.roomBoundaries.y);
            this.house.addRoom(this.roomBoundaries.x, mouseY, this.roomBoundaries.w, calcVar);
            this.house.unselectAll();
        }else if(this.selectedWallArray[0].type == "horizontal" && this.selectedWallArray[0].type == this.selectedWall.type){
            var calcVar = abs(this.roomBoundaries.x + this.roomBoundaries.w - mouseX);
            this.house.alterRoom(this.roomBoundaries, this.roomBoundaries.x, this.roomBoundaries.y, mouseX - this.roomBoundaries.x ,this.roomBoundaries.h);
            this.house.addRoom(mouseX, this.roomBoundaries.y, calcVar, this.roomBoundaries.h);
            this.house.unselectAll();
        }else{
            this.selectedWall = null;
            this.roomBoundaries = null;
        }
    }else{
        this.selectedWall = null;
        this.roomBoundaries = null;
    }
}
