let input = document.getElementById('myInput');
let form = document.getElementById('myForm');
let select = document.getElementById('category')




form.addEventListener('submit', function(event) {
  event.preventDefault();
  console.log(select.value);
  axios.post('update.php', {
    'value': input.value,
    'selectID': select.value,
  }).then(function(response) {
    location.reload();
    $_SESSION['flag'] = false;
    console.log(response.data);
  }).catch(function(error) {
    console.log(error);
  });
});