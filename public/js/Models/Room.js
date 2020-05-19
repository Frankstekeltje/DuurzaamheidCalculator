class Room{
    constructor(x, y, w, h){
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;
        this.selected = false;
    }

    show(){
        push();
        (this.selected) ? fill(125) : fill(255);
        rect(this.x, this.y, this.w, this.h);
        pop();
    }

    roomSelected(pointerX, pointerY){
        console.log(pointerX, pointerY, this.x, this.y, this.w, this.h);
        if((pointerX < (this.x + this.w)) && (pointerX > this.x) && (pointerY < (this.y + this.h)) && (pointerY > this.y)){
            this.selected = true;
        }else{
            this.selected = false;
        }
    }
}
