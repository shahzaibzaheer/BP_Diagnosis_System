const DRAWER_ICON = document.getElementById('drawer_icon');
const MAIN_DRAWER = document.getElementsByClassName('drawer')[0];
const POPOVER_BTN = document.getElementById('welcome_drop_down_btn');
// const FEEDBACK_BTN = document.getElementById('feedbackBtn');
const POPOVER = document.getElementsByClassName('popOver')[0];
const BODY = document.getElementsByTagName('body')[0];







DRAWER_ICON.addEventListener("click", toggleDrawer);
POPOVER_BTN.addEventListener('click', function(e){
  togglePopOver(e);
});


 // agr popOver open hy aur body per click ho to pop over close ho jaey
BODY.addEventListener('click', function(e){
  POPOVER.classList.remove('popOver_open');
  POPOVER_BTN.classList.remove('open');
});



function toggleDrawer(){
  MAIN_DRAWER.classList.toggle('drawer_collapse');
}

function togglePopOver(e){
  POPOVER_BTN.classList.toggle('open');
  POPOVER.classList.toggle('popOver_open');
  e.stopPropagation();
}

  //
  // FEEDBACK_BTN.click(function(){
  // 		$("#feedbackModal").modal('show');
  // 	});


// $(document).ready(function(){
// 	$(".btn").click(function(){
// 		$("#myModal").modal('show');
// 	});
// });

  // function printPatientReport(){
  //   var originalContents = document.body.innerHTML;
  //   document.body.innerHTML = patientReportContent;
  //   window.print();
  //   document.body.innerHTML = originalContents;
  // }
  // function printDoctorReport(){
  //   var originalContents = document.body.innerHTML;
  //   document.body.innerHTML = doctorReportContent;
  //   window.print();
  //   document.body.innerHTML = originalContents;
  // }
