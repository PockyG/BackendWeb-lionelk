// Jitter class
// function Jitter() {
//     this.x = random(width);
//     this.y = random(height);
//     this.diameter = random(10, 30);
//     this.speed = 1;
  
//     this.move = function() {
//       this.x += random(-this.speed, this.speed);
//       this.y += random(-this.speed, this.speed);
//     };
  
//     this.display = function() {
//       ellipse(this.x, this.y, this.diameter, this.diameter);
//     };
//   }
var dropID = 0;

  class Drop{

    constructor() {
      this.id = dropID;
      this.x = random(0,windowWidth);
      this.y = random( -100, 0);
      this.fallSpeed = random(1,8);
      this.isAlive = true;    
      this.length = 0 + (this.fallSpeed * 4);
      dropID++;
      
    }

    draw(){
      this.y += this.fallSpeed;


      fill(150,73,203);
      stroke(150, 73, 203);
      strokeWeight(this.fallSpeed/3);
      line(this.x, this.y, this.x, this.y + this.length);

      if(this.y > canvasHeight){
        //this.isAlive = false;
        this.y = random(-100,0);

      }
    }
  }