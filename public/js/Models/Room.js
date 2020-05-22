class Room{
    constructor(x, y, w, h){
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;
        this.selected = false;
        this.walls = [];
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
        for(var i = 0; i < this.walls.length; i++){
            this.walls[i].wallSelected(mouseX, mouseY);
        }
    }

    wallHover(){
        for(var i = 0; i < this.walls.length; i++){
            this.walls[i].wallHover(mouseX, mouseY);
        }
    }
}
