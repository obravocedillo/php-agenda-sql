$(function(){
  var l = new Login();
})


class Login {
  constructor() {
    this.submitEvent()
  }

  submitEvent(){
    $('form').submit((event)=>{
      event.preventDefault()
      this.sendForm()
    })
  }

  sendForm(){
    let form_data = new FormData();
    form_data.append('username', $('#user').val())
    form_data.append('password', $('#password').val())
    $.ajax({
      url: '../server/check_login.php',
      cache: false,
      dataType:   "json",
      processData: false,
      contentType: false,
      data: form_data,
      type: 'POST',
      success: function(php_response){
          console.log(php_response);
        if (php_response.msg == "OK") {
            window.location.href = 'main.html';
        }else {
          alert(php_response.msg);
        }
      }
    }).done(function(data){
          console.log(data);
      })
  }
}
