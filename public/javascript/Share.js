document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];

    document.getElementById('share').addEventListener('click', function() {
        modal.style.display = "block";
    });

    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    
    var pageUrl = encodeURIComponent(window.location.href);
    var shareText = encodeURIComponent("Check out this blog post on h8!");

    document.getElementById('share-facebook').href = `https://www.facebook.com/sharer/sharer.php?u=${pageUrl}`;
    document.getElementById('share-twitter').href = `https://twitter.com/intent/tweet?url=${pageUrl}&text=${shareText}`;
    document.getElementById('share-linkedin').href = `https://www.linkedin.com/shareArticle?mini=true&url=${pageUrl}`;

    var shareOptions = document.querySelectorAll('#share-facebook, #share-twitter, #share-linkedin');
    shareOptions.forEach(function(option) {
        option.addEventListener('click', function(e) {
            e.preventDefault();
            window.open(this.href, 'Share', 'width=600,height=400');
        });
    });
});