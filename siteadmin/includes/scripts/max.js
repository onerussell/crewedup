// Get the HTTP Object
function getHTTPObject(){
   if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
   else if (window.XMLHttpRequest) return new XMLHttpRequest();
   else {
      alert("Your browser does not support AJAX.");
      return null;
   }
}   

// Change the value of the outputText field
function setOutput(){
   if(httpObject.readyState == 4){
      document.getElementById('myBody').innerHTML = httpObject.responseText;
   }
}

// Implement business logic
function loadSite(){
   httpObject = getHTTPObject();
   if (httpObject != null) {
      httpObject.open("GET", "content.php", true);
      httpObject.send(null);
      httpObject.onreadystatechange = setOutput;
   }
}
 
var httpObject = null;
