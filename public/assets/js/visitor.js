var referrer=document.referrer;
var userAgent=navigator.userAgent.toLowerCase();
var browser;
if(userAgent.indexOf('edge')>-1){
  browser='IEedge';
}else if(userAgent.indexOf('whale')>-1){
  browser='Whale';
}else if(userAgent.indexOf('chrome')>-1){
  browser='Chrome';
}else if(userAgent.indexOf('firefox')>-1){
  browser='Firefox';
}else if(userAgent.indexOf('safari')>-1){
  browser='safari';
}else{
  browser='IE';
}

//쿠키가 없으면 작동
$.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type: 'post',
     url: '/visitor_save',
     dataType: 'text',
     data: {
       'referrer': referrer,
       'browser': browser
     },
     success: function(data) {
     },
     error: function(data) {
          console.log("error" +data);
     }
});
