export sclass Chart {
  constructor(idol){
    this.count = 0;
    this.idol = idol;
  }
  addList(idol){
    this.idol = idol.concat(this.idol);
    console.log(idol);
  }
  show(start = 0,pageRow = 5){
    con.innerHTML = '' ;
    for(let i = 0 ; idol[i]!=null ; i++){
      if(i==pageRow+this.count){
        this.count += 5;
        con.innerHTML += `<button onclick="wa.show()">more</button>`;
        break;
      }
      con.innerHTML += `top${i+1} ${idol[i]}<br>`;
    }
  }
  hidden(){
    this.count = 0;
    con.innerHTML = `<button onclick="wa.show()">보이기</button>`;
  }
}
