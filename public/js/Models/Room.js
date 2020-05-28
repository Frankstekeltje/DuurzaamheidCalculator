class Room{
    x;
    y;
    w;
    h;

    houseX;
    houseY;
    houseW;
    houseH;

    selected = false;

    walls = [];

    type = "";

    constructor(x, y, w, h){
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;
        this.createWalls();
    }

    show(){
        push();
        noStroke();
        (this.selected) ? fill(153, 255, 153) : fill(255);
        rect(this.x, this.y, this.w, this.h);
        for(var i = 0; i < this.walls.length; i++){
            this.walls[i].show();
        }
        pop();
    }

    houseBoundaries(houseX, houseY, houseW, houseH){
        this.houseX = houseX;
        this.houseY = houseY;
        this.houseW = houseW;
        this.houseH = houseH;
    }

    roomSelected(pointerX, pointerY){
        if((pointerX < (this.x + this.w - 3)) && (pointerX > this.x + 3) && (pointerY < (this.y + this.h - 3)) && (pointerY > this.y + 3)){
            this.selected = true;
        }else{
            this.selected = false;
        }
        return this.selected;
    }

    wallSelected(){
        var selectedWall = null;
        for(var i = 0; i < this.walls.length; i++){
            var tempWall = this.walls[i].wallSelected(mouseX, mouseY);
            if(tempWall.selected) selectedWall = tempWall;
        }
        return (selectedWall == null) ? selectedWall : [selectedWall, this];
    }

    wallHover(){
        for(var i = 0; i < this.walls.length; i++){
            this.walls[i].wallHover(mouseX, mouseY);
        }
    }

    houseContainsWall(wall){
        var pointer = wall.getWallMid();
        if((pointer.x < (this.houseX + this.houseW - 2)) && (pointer.x > this.houseX + 2) && (pointer.y < (this.houseY + this.houseH - 2)) && (pointer.y > this.houseY)){
            return "inside";
        }
        return "outside";
    }

    unselectAll(){
        this.selected = false;
        for(var i = 0; i < this.walls.length; i++){
            this.walls[i].unselect();
        }
    }

    alterRoom(x, y, w, h){
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;

        this.createWalls();
    }

    createWalls(){
        this.walls = [];
        var wall1 = new Wall(this.x, this.y, this.x + this.w, this.y)
        var wall2 = new Wall(this.x, this.y, this.x, this.y + this.h);
        var wall3 = new Wall(this.x, this.y + this.h, this.x + this.w, this.y + this.h);
        var wall4 = new Wall(this.x + this.w, this.y, this.x + this.w, this.y + this.h);

        wall1.setWallType(this.houseContainsWall(wall1));
        wall2.setWallType(this.houseContainsWall(wall2));
        wall3.setWallType(this.houseContainsWall(wall3));
        wall4.setWallType(this.houseContainsWall(wall4));

        this.walls.push(wall1, wall2, wall3, wall4);
    }

    changeType(value){
        this.type = value;
    }

    changeW(value){
        this.w = value;
        this.createWalls();
    }

    changeH(value){
        this.h = value;
        this.createWalls();
    }
}
