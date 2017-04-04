
// internal representation of the game board
class Board{
	constructor(){
		// initialize internal 2-d (4*4) array 
		this.arr = [
			[0,0,0,0],
			[0,0,0,0],
			[0,0,0,0],
			[0,0,0,0]
		];
		// initialize empty list and setup all element on board
		this.emptyList = [];
		this.reset();
		// randomly pick two empty element and set them to either 2 or 4;
		this.giveBirth(this.pickEmpty());
		this.giveBirth(this.pickEmpty());

	}

	// randomly pick one element from the empty list, return its index, if there is no empty element, return -1.
	pickEmpty(){
		if(this.emptyList.length === 0){
			return -1;
		}else{
			var index = this.getRandom(0,this.emptyList.length-1);
			return this.emptyList[index];
		}
	}

	// set a new element to either 2 or 4 refering by index.
	giveBirth(index){
		// prob to set 2 is larger
		if(this.getRandom(1,100)<=66){
			this.set(index, 2);
		}else{
			this.set(index, 4);
		}
		// remove this index from emptyList
		this.listRemove(this.emptyList, index);
	}

	// set up element
	set(index, num){
		var index2d = this.arrayIndex(index);
		this.arr[index2d[0]][index2d[1]] = num;
		this.setCss(index, num);
	}
	// set up css style for element
	setCss(index, num){
		// select the target 
		var str = "#elem_";
		str += index;
		var elem= document.querySelector(str);
		// change style
		if(num===0){
			elem.textContent = "";
		}else{
			elem.textContent = num;
		}
		// remove all previous class
		$(str).removeClass();
		elem.classList.add("num_" + num);
	}

	// transfer 1D index to 2D index
	arrayIndex(index){
		return [Math.floor(index/4), index%4];
	}

	// remove this element from list
	listRemove(list, element){
		var index = list.indexOf(element);
		if(index > -1){
			list.splice(index,1);
		}
	}

	// get random number between min and max
	getRandom(min, max) {
  		return Math.floor(Math.random() * (max - min)) + min;
	}

	// triggered when user input a down arrow
	arrDown(){
		for(var j = 0; j< 4; j++){
			// from col_0 to col_3
			var res = [];
			var cur_row = 3;
			var pre_num = 0;
			// move element and save res to res
			while(cur_row >= 0){
				var cur_num = this.arr[cur_row][j];
				if(cur_num != 0){
					if(cur_num == pre_num){
						res.pop();
						res.push(cur_num*2);
						pre_num = 0;
					}else{
						res.push(cur_num);
						pre_num = cur_num;
					}
				}
				cur_row--;
			}
			// write res to the array
			var t=0;
			cur_row = 3;
			for(; t<res.length; t++, cur_row--){
				this.arr[cur_row][j] = res[t];
			}
			for(;cur_row>=0;cur_row--){
				this.arr[cur_row][j] = 0;
			}
		}
	}

	// triggered when user input a up arrow
	arrUp(){
		for(var j = 0; j< 4; j++){
			// from col_0 to col_3
			var res = [];
			var cur_row = 0;
			var pre_num = 0;
			// move element and save res to res
			while(cur_row < 4){
				var cur_num = this.arr[cur_row][j];
				if(cur_num != 0){
					if(cur_num == pre_num){
						res.pop();
						res.push(cur_num*2);
						pre_num = 0;
					}else{
						res.push(cur_num);
						pre_num = cur_num;
					}
				}
				cur_row++;
			}
			// write res to the array
			var t=0;
			cur_row = 0;
			for(; t<res.length; t++, cur_row++){
				this.arr[cur_row][j] = res[t];
			}
			for(;cur_row<4;cur_row++){
				this.arr[cur_row][j] = 0;
			}
		}
	}

	// triggered when user input a right arrow
	arrRight(){
		for(var j = 0; j< 4; j++){
			// from row_3 to row_0
			var res = [];
			var cur_row = 3;
			var pre_num = 0;
			// move element and save res to res
			while(cur_row >= 0){
				var cur_num = this.arr[j][cur_row];
				if(cur_num != 0){
					if(cur_num == pre_num){
						res.pop();
						res.push(cur_num*2);
						pre_num = 0;
					}else{
						res.push(cur_num);
						pre_num = cur_num;
					}
				}
				cur_row--;
			}
			// write res to the array
			var t=0;
			cur_row = 3;
			for(; t<res.length; t++, cur_row--){
				this.arr[j][cur_row] = res[t];
			}
			for(;cur_row>=0;cur_row--){
				this.arr[j][cur_row] = 0;
			}
		}
	}

	// triggered when user input a left arrow
	arrLeft(){
		for(var j = 0; j< 4; j++){
			// from row_0 to row_3
			var res = [];
			var cur_col = 0;
			var pre_num = 0;
			// move element and save res to res
			while(cur_col < 4){
				var cur_num = this.arr[j][cur_col];
				if(cur_num != 0){
					if(cur_num == pre_num){
						res.pop();
						res.push(cur_num*2);
						pre_num = 0;
					}else{
						res.push(cur_num);
						pre_num = cur_num;
					}
				}
				cur_col++;
			}
			// write res to the array
			var t=0;
			cur_col = 0;
			for(; t<res.length; t++, cur_col++){
				this.arr[j][cur_col] = res[t];
			}
			for(;cur_col<4;cur_col++){
				this.arr[j][cur_col] = 0;
			}
		}
	}

	// reset visual board and emptylist acoording to inner array
	reset(){
		this.emptyList = [];
		for(var i=0;i<16;i++){
			var index2d=this.arrayIndex(i);
			var num = this.arr[index2d[0]][index2d[1]];
			this.set(i,num);
			if(num===0){
				this.emptyList.push(i);
			}
		}
	}

	// move for public use
	move(dir){
		if(dir==="left"){
			this.arrLeft();
		}else if(dir==="right"){
			this.arrRight();
		}else if(dir==="up"){
			this.arrUp();
		}else if(dir==="down"){
			this.arrDown();
		}
		this.reset();
		// randomly pick two empty element and set them to either 2 or 4;
		this.giveBirth(this.pickEmpty());
		this.giveBirth(this.pickEmpty());
	}

	// // member vars
	// // internal 2-D array
	// var arr;
	// // list of element that is empty
	// var emptyList;
}


// main logic
var board = new Board();
document.onkeydown = function(evt){
	switch(evt.keyCode){
		// left
		case 37:
			board.move("left");
			break;	
		// up	
		case 38:
			board.move("up");
			break;
		// right	
		case 39:
			board.move("right");
			break;	
		// down
		case 40:
			board.move("down");
			break;
	}
}