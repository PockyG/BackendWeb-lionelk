

let yea = [];


var canvasWidth = 640;
var canvasHeight = 360;


// var testString = ['y','e','a','b','o','i'];
// for(var i = 0; i < testString.length; i++){

//     if(testString[i] == 'a'){
//         testString.splice(i,1);
        
//     }

//     print(testString[i]);
// }

function setup(){
    createCanvas(canvasWidth, canvasHeight);
    print("wtf");
    for(let i = 0; i < 400; i++){
        yea.push(new Drop());
    }
}

    

function draw(){
    background(230,230,250);
    
    //yea.push(new Drop());

    for(let i = 0; i < yea.length; i++){

        if(yea[i].isAlive == false){
            yea.splice(i,1);
           // print("dead");
            continue;
        }

        yea[i].draw();
        

    }



}