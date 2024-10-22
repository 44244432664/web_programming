function activate(id, parent) {
    var parent = document.getElementById(parent);
    // console.log(parent);
    // console.log(parent.children);
    var children = parent.children;
    // console.log(children.length);
    for (var i = 0; i < children.length; i++) {
        // console.log(children[i]);
        children[i].classList.remove("active");
        if (children[i].id == id) {
            children[i].classList.add("active");
        }
    }
}


function get_books() {
    // fetch('https://freetestapi.com/api/v1/books')
    //     .then(response => response.json())
    //     .then(data => {
    //         console.log(data);
    //         var books = document.getElementById('books');
    //         books.innerHTML = '';
    //         for (var i = 0; i < data.length; i++) {
    //             var book = document.createElement('div');
    //             book.innerHTML = data[i].title;
    //             books.appendChild(book);
    //         }
    //     })
    //     .catch(error => console.error('Error:', error));

    fetch('https://freetestapi.com/api/v1/books')
        .then(response => response.json())
        .then(data => {
            console.log(data);

            // Convert data to JSON string
            const jsonData = JSON.stringify(data);

            // Create a Blob from the JSON string
            const blob = new Blob([jsonData], { type: 'application/json' });

            // Create a download link
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'books.json';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        })
        .catch(error => console.error('Error:', error));

    console.log('After fetch');
}



function category_form() {
    var new_cat_group = document.getElementById('new_cat_form');

    new_cat_group.innerHTML = "<div class='form-control-inline'>\
                    <input class='form-control-input' type='text' placeholder='New Category' onkeypress='add_category(this.value)'>\
                    </div>";
}

function add_category(value) {
    if (value.keyCode == 13) {
        console.log(value);

        var cat = "";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                cat = this.responseText;
            }
        };
        xmlhttp.open("GET", "functions.php?f=new_category?cat="+value, true);
        xmlhttp.send();

        var cat_group = document.getElementById('categories');
        if (cat != "") {
            var new_cat = "<div class='form-check form-check-inline'>\
                            <input class='form-check-input' type='checkbox' name='" + cat + "value='" + cat + ">\
                            <label class='form-check-label' for='" + cat + "'>" + cat + "</label>\
                            </div>";
            cat_group.innerHTML += new_cat;
        }
        else {
            console.log('Category not added');
        }

        var new_cat_group = document.getElementById('new_cat_form');
        new_cat_group.innerHTML = "<div class='btn btn-primary' onclick='add_category()'>Add Category</div>";
    }

}



// function select_category(sel) {
//     // sel.preventDefault();
//     cat = []
//     var category = sel.options[sel.selectedIndex].value;
//     console.log(category);
//     cat.push(category);
//     // sel.options[sel.selectedIndex].selected = !sel.options[sel.selectedIndex].selected;
//     // el = sel.options[sel.selectedIndex];
//     // console.log(sel.options[sel.selectedIndex]);
//     console.log(cat);
//   }

// function select_category(sel) {
//     // sel.preventDefault();
//     e = sel.options[sel.selectedIndex];
//     console.log(e);
//     e.setAttribute('selected', 'selected');
//     console.log(e);
// }

// function select_this(e) {
//     console.log(e);
//     e.setAttribute('selected', 'selected');
//     console.log(e);
// }
    


/////////////////////////////////////////////////
// var control_element = [];
// function limit_clicks(id) {
//     console.log(control_element);
//     if (control_element.includes(id)) {
//         var button = document.getElementById(id);
//         button.disabled = true;
//         button.innerHTML = 'Clicked';
//         button.href = '#';
//     }
//     else {
//         control_element.push(id);
//     }
//     // console.log(control_element);
// }