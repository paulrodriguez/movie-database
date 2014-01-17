var xmlhttp = createXmlHttpRequestObject();


// retrieves the XMLHttpRequest object
function createXmlHttpRequestObject() 
{	
  // will store the reference to the XMLHttpRequest object
  var xmlhttp;
  // if running Internet Explorer
  if(window.XMLHttpRequest)
  {
    try
    {
	xmlhttp = new XMLHttpRequest();
	
    }
    catch (e) 
    {
      xmlhttp = false;
    }
  }
  // if running Mozilla or other browsers
  else
  {
    try 
    {
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    catch (e) 
    {
      xmlhttp = false;
    }
  }
  // return the created object or display an error message
  if (!xmlhttp)
 
    alert("Error creating the XMLHttpRequest object.");
  else 
    return xmlhttp;
}




function processActor() {
var str = document.getElementById("actor").value;
if (str.length==0)
  { 
  document.getElementById("actorInfo").innerHTML="";
  return;
  }
 // xmlhttp = createXmlhttpRequestObject();
 //createXmlHttpRequestObject();
 
xmlhttp.onreadystatechange = getActor;
//edit 1
xmlhttp.open("GET","/movies/controller/actors.php?aid="+str+"&ajax=1",true);
xmlhttp.send();
}


function getActor() {
	if(xmlhttp.readyState==4 && xmlhttp.status == 200) {
		document.getElementById("actorInfo").innerHTML = xmlhttp.responseText;
	}
}


function processMovie() {
	var str = document.getElementById("movie").value;
if (str.length==0)
  { 
  document.getElementById("movieInfo").innerHTML="";
  return;
  }
 // createXmlhttpRequestObject();
  

xmlhttp.onreadystatechange = getMovie;
xmlhttp.open("GET","/movies/controller/movies.php?mid="+str+"&ajax=1",true);
xmlhttp.send();
}

function getMovie() {
	if(xmlhttp.readyState==4 && xmlhttp.status == 200) {
		document.getElementById("movieInfo").innerHTML = xmlhttp.responseText;
	}
}