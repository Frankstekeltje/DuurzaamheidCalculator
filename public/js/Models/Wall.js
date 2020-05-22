class Wall{
    constructor(x1, y1, x2, y2){
        this.x1 = x1;
        this.x2 = x2;
        this.y1 = y1;
        this.y2 = y2;

        this.thickness = 5;

        this.selected = false;
        this.hover = false;
    }

    show(){
        push();
        strokeWeight(this.thickness);
        stroke(125);
        if(this.selected)stroke(255, 0, 0);
        if(this.hover)stroke(255, 0, 255);
        line(this.x1, this.y1, this.x2, this.y2);
        pop();
    }

    wallSelected(pointerX, pointerY){
        if(this.x1 == this.x2){
            if(pointerY < this.y2 && pointerY > this.y1 && pointerX < this.x1 + (this.thickness) && pointerX > this.x1 - (this.thickness)){
                this.selected = true;
                return;
            }
        }else if(this.y1 == this.y2){
            if(pointerX < this.x2 && pointerX > this.x1 && pointerY < this.y1 + (this.thickness) && pointerY > this.y1 - (this.thickness)){
                this.selected = true
                return;
            }
        }else{
        }
        this.selected = false;
    }

    wallHover(pointerX, pointerY){
        if(!this.selected){
            if(this.x1 == this.x2){
                if(pointerY < this.y2 && pointerY > this.y1 && pointerX < this.x1 + (this.thickness) && pointerX > this.x1 - (this.thickness)){
                    this.hover = true;
                    return;
                }
            }else if(this.y1 == this.y2){
                if(pointerX < this.x2 && pointerX > this.x1 && pointerY < this.y1 + (this.thickness) && pointerY > this.y1 - (this.thickness)){
                    this.hover = true
                    return;
                }
            }else{
            }
        }
        this.hover = false;
    }
}
