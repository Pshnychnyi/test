document.getElementById('form').addEventListener('submit', async function(event) {
    event.preventDefault();
    const url = document.querySelector('#url').value;

    const formData = await new FormData(this)


    const response = await fetch(this.action, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': formData.get('_token')
        },
        body: JSON.stringify({url: url})
    })
    const answer = await response.json();

    const newUrl = answer.new_url;
    document.querySelector('#newUrl').href = newUrl
    document.querySelector('#newUrl').innerHTML = newUrl


});
