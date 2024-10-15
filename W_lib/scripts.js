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



var control_element = [];
function limit_clicks(id) {
    console.log(control_element);
    if (control_element.includes(id)) {
        var button = document.getElementById(id);
        button.disabled = true;
        button.innerHTML = 'Clicked';
        button.href = '#';
    }
    else {
        control_element.push(id);
    }
    // console.log(control_element);
}