window.onload = function(){

    var country= document.getElementById('country');
    var searchBtn = document.getElementById('lookup');
    var resultsDiv = document.getElementById('results');

    var request = new XMLHttpRequest();

    searchBtn.addEventListener("click", function(e){
        e.preventDefault();
        var url = "world.php?country=" + country.value;
        request.onreadystatechange = fetch;
        request.open('GET', url);
        request.send();
    });

    function fetch(){
        if (request.readyState === XMLHttpRequest.DONE){
            if (request.status === 200){
                var response = request.responseText;
                resultsDiv.innerHTML = response;
            }
            else{
                resultsDiv.innerHTML = "An error occurred while making the request. Unable to fetch data.";
            }
        }
    }

};
    