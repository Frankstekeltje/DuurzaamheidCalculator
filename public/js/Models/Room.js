class Room{
    x;
    y;
    w;
    h;

    selected = false;

    walls = [];

    type;

    constructor(x, y, w, h){
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;
        this.walls.push(new Wall(this.x, this.y, this.x + this.w, this.y));
        this.walls.push(new Wall(this.x, this.y, this.x, this.y + this.h));
        this.walls.push(new Wall(this.x, this.y + this.h, this.x + this.w, this.y + this.h));
        this.walls.push(new Wall(this.x + this.w, this.y, this.x + this.w, this.y + this.h));
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

    roomSelected(pointerX, pointerY){
        if((pointerX < (this.x + this.w)) && (pointerX > this.x) && (pointerY < (this.y + this.h)) && (pointerY > this.y)){
            this.selected = true;
        }else{
            this.selected = false;
        }
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

    unselectAll(){
        this.selected = false;
        for(var i = 0; i < this.walls.length; i++){
            this.walls[i].unselect();
        }
    }

    alterRoom(x, y, w, h){
        this.walls = [];
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;

        this.walls.push(new Wall(this.x, this.y, this.x + this.w, this.y));
        this.walls.push(new Wall(this.x, this.y, this.x, this.y + this.h));
        this.walls.push(new Wall(this.x, this.y + this.h, this.x + this.w, this.y + this.h));
        this.walls.push(new Wall(this.x + this.w, this.y, this.x + this.w, this.y + this.h));
    }
}
