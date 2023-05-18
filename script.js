let input = document.getElementById('myInput');
let form = document.getElementById('myForm');
let select = document.getElementById('category')
let addNewExpenses = document.getElementById('addNewExpenses');
let mySecondForm = document.getElementById('mySecondForm');
let newAccount = document.getElementById('new');
let clear = document.getElementById('clearExpenses');
let newExpensesInput = null;
let myThirdForm = null;
let changes = document.getElementsByClassName('change');



for (let i = 0; i < changes.length; i++) {
  changes[i].addEventListener('click', function(event) {
    event.preventDefault(); // предотвращаем переход по ссылке
    let id = i + 1;
    
    if (myThirdForm) {
      myThirdForm.remove();
      myThirdForm = null;
    } else {
    myThirdForm = document.createElement('form');
    myThirdInput = document.createElement('input');
    myThirdButton = document.createElement('button');
    const tr = this.parentNode.parentNode; // получаем родительский элемент (строку таблицы)
    const td = document.createElement('td'); // создаем новый элемент td
    td.appendChild(myThirdForm); // добавляем текст в новый элемент
    tr.insertBefore(td, this.parentNode.nextSibling); // вставляем новый элемент после ячейки с ссылкой
    myThirdForm.appendChild(myThirdInput);
    myThirdForm.appendChild(myThirdButton);
    myThirdButton.innerHTML = "Сохранить";
    myThirdInput.setAttribute("placeholder", "Введите измененную сумму");
    myThirdInput.setAttribute("name", "changed");
    myThirdInput.setAttribute("id", "changed");

    myThirdForm.addEventListener('submit', function(event) {
      event.preventDefault();
      axios.post('update.php',
          {"changedValue" : myThirdInput.value,
           "ID": id,}
      ).then(function(res) {
        location.reload();
        console.log(res)
      }).catch(function(error){
        console.log(error)
      })
    });
  }});
}

newAccount.addEventListener('click', function(event) {
  if (newExpensesInput) {
    // Если input уже создан, то удаляем его
    newExpensesButton.remove();
    newExpensesInput.remove();
    newExpensesInput = null;
  } else {
    // Если input еще не создан, то создаем его
    newExpensesInput = document.createElement('input');
    newExpensesButton = document.createElement('button');
    mySecondForm.appendChild(newExpensesInput);
    mySecondForm.appendChild(newExpensesButton);
    newExpensesInput.setAttribute("name", "newAccount");
    newExpensesInput.setAttribute("id", "newAccount");
    newExpensesInput.setAttribute("placeholder", "Введите новый счет");
    newExpensesInput.setAttribute("type", "number");
    newExpensesButton.innerHTML = "Сохранить";
    mySecondForm.addEventListener('submit', function(event) {
      event.preventDefault();
      console.log(newExpensesInput.value);
      axios.post('update.php',
      {'newBalance' : newExpensesInput.value,}
      ).then(function(res) {
        location.reload();
        console.log(res);
      }).catch(function(error){
        console.log(error)
      })
  })
  }
});


addNewExpenses.addEventListener('click', function(event) {
  if (newExpensesInput) {
    // Если input уже создан, то удаляем его
    newExpensesButton.remove();
    newExpensesInput.remove();
    newExpensesInput = null;
  } else {
    newExpensesInput = document.createElement('input');
    newExpensesButton = document.createElement('button');
    mySecondForm.appendChild(newExpensesInput);
    mySecondForm.appendChild(newExpensesButton);
    newExpensesInput.setAttribute("id", "addNewExpenses");
    newExpensesInput.setAttribute("placeholder", "Введите новый вид трат");
    newExpensesButton.innerHTML = "Сохранить";
    mySecondForm.addEventListener('submit', function(event) {
      event.preventDefault();
      axios.post('update.php',
      {'newExpenses' : newExpensesInput.value,}
      ).then(function(res) {
        location.reload();
        console.log(res);
      }).catch(function(error){
        console.log(error)
      })
  })
  }
});

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