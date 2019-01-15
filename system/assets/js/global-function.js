function formatDatePicker(param) {
  var date = new Date(param);
  var monthNames = [
    "Jan", "Feb", "Mar",
    "Apr", "May", "Jun", "Jul",
    "Aug", "Sep", "Oct",
    "Nov", "Dec"
  ];

  var day = date.getDate();
  var monthIndex = date.getMonth();
  var year = date.getFullYear().toString().substr(-2);
  var hour = date.getHours();
  var minutes = date.getMinutes();
  var seconds = date.getSeconds();

  return day + "-" + monthNames[monthIndex] + "-" + year;
}

function checkFullName(first_name, middle_name, last_name){
  return first_name + (middle_name != "" ? " " + middle_name + " " + last_name : " " + last_name);
}

function isDataChanges(array){
  var index = 0;
  var check_values = new Array();
  for(var i=0; i < array.length; i++){
    if(array[i][0] == array[i][1]){
      check_values[index] = i;
      index++;
    }
  }
  return check_values.length == array.length ? false : true;
}

function previewImage(x){
  var url = $(x).attr("data-url");
  var module = $(x).attr("data-module");
  var img = $(x).attr("data-img");
  var link = getUploadFile(url, module, "", img);
  x.href = link;
  setTimeout(function() {
      x.href = "javascript:void(0)";
  }, 300);
}

function getUploadFile(url, module, thmb, data){
  var result;
  data = data.trim();
  if(data != ""){
    switch (module) {
      case "admin":
        result = url+"uploads/admin/"+thmb+data;
      break;
      default:
        result = url+"img/placeholder-image.png";
      break;
    }
  }else{
    if(module == "admin"){
      result = url+"img/placeholder-anonymous.jpg";
    }else{
      result = url+"img/placeholder-image.png";
    }
  }
  return result;
}

function sizeFile(file){
  return file.value != "" ? file.files[0].size : "";
}

function checkFormatImage(value){
  var val = value.toLowerCase();
  var regex = new RegExp("(.*?)\.(jpg|jpeg|png)$");
  if(!(regex.test(val))){
    return false;
  }else{
    return true;
  }
}

//success alert
function successAlert(text){
  Command: toastr["success"](text)
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
}

//error alert
function errorAlert(text){
  Command: toastr["error"](text)
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
}