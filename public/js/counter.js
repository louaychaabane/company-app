let valueDisplays = document.querySelectorAll(".num");
let duration = 3000; // 3 seconds

valueDisplays.forEach((valueDisplay) => {
  let startValue = 0;
  let endValue = parseInt(valueDisplay.getAttribute("data-val"));
  let inc  
  if(endValue<100) {
    inc=1
  }else if(endValue>5000){
    inc=55
  }else{
    inc=11
  }
  let counter = setInterval(function () {
    startValue += inc;
    if (startValue >= endValue) {
      startValue = endValue;
      clearInterval(counter);
    }
    valueDisplay.textContent = startValue;
  }, 10);
});
