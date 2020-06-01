class House{
    selected = false;
    rooms = [];

    x;
    y;
    w;
    h;

    constructor(x, y, w, h){
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;

        var room = new Room(x,y,w,h);
        room.houseBoundaries(this.x, this.y, this.w, this.h);

        this.rooms.push(room);
    }

    show(){
        for(var i = 0; i < this.rooms.length; i++){
            push();
            this.rooms[i].show();
            pop();
        }
    }

    houseSelected(){
        var selectedRoom = null;
        for(var i = 0; i < this.rooms.length; i++){
            if(this.rooms[i].roomSelected(mouseX, mouseY)) selectedRoom = this.rooms[i];
        }
        return selectedRoom;
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
    }

    calcNeighbours(){
        for(let i = 0; i < this.rooms.length; i++){
            var mainRoom = this.rooms[i];
            for(let j = 0; j < this.rooms.length; j++){
                if(i == j) continue;
                var calcRoom = this.rooms[j];
                if(this.roomTouches(mainRoom, calcRoom)){
                    mainRoom.addNeighbour(calcRoom);
                }
            }
        }
    }

    roomTouches(room1, room2){
        if(room1.x + room1.w == room2.x || room1.y + room1.h == room2.y) return true;
    }

    addRoom(x, y, w, h){
        var room = new Room(x, y, w, h);
        room.houseBoundaries(this.x, this.y, this.w, this.h);
        this.rooms.push(room);
    }

    alterRoom(room, newX, newY, newW, newH){
        for(var i = 0; i < this.rooms.length; i++){
            if(this.rooms[i].x == room.x && this.rooms[i].y == room.y) this.rooms[i].alterRoom(newX, newY, newW, newH);
        }
    }

    removeRoom(room){
        for (let i = 0; i < this.rooms.length; i++) {
            if(this.rooms[i].x == room.x && this.rooms[i].y == room.y) this.rooms.splice(i, 1);
        }
    }

    removeWall(wall){

    }
}
