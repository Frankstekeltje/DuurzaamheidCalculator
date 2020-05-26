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
        var selectedWall = null;
        for(var i = 0; i < this.rooms.length; i++){
            var tempWall = this.rooms[i].wallSelected();
            if(Array.isArray(tempWall)) selectedWall = tempWall;
        }
        return selectedWall;
    }

    wallHover(){
        for(var i = 0; i < this.rooms.length; i++){
            this.rooms[i].wallHover()
        }
    }

    unselectAll(){
        this.selected = false;
        for(var i = 0; i < this.rooms.length; i++){
            this.rooms[i].unselectAll();
        }
        console.log(this.rooms);
    }

    addRoom(x, y, w, h){
        console.log(x,y,w,h);
        this.rooms.push(new Room(x, y, w, h));
    }

    alterRoom(room, newX, newY, newW, newH){
        for(var i = 0; i < this.rooms.length; i++){
            if(this.rooms[i].x == room.x && this.rooms[i].y == room.y) this.rooms[i].alterRoom(newX, newY, newW, newH);
        }
    }
}
