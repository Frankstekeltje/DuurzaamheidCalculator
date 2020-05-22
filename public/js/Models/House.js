class House{
    constructor(x, y, w, h){
        this.selected = false;
        this.rooms = [];
        this.rooms.push(new Room(x, y, w, h));
    }

    show(){
        for(var i = 0; i < this.rooms.length; i++){
            push();
            this.rooms[i].show();
            pop();
        }
    }

    houseSelected(){
        for(var i = 0; i < this.rooms.length; i++){
            this.rooms[i].roomSelected(mouseX, mouseY);
        }
    }

    wallSelected(){
        for(var i = 0; i < this.rooms.length; i++){
            this.rooms[i].wallSelected()
        }
    }

    wallHover(){
        for(var i = 0; i < this.rooms.length; i++){
            this.rooms[i].wallHover()
        }
    }
}
