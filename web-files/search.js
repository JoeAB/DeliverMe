

function validate()
{

if ((document.getElementById("search").value).trim()==""||document.getElementById("search").value==null)
  { 
     alert("Search cannot be empty. Please try again.");
     return false;
  }
  else
    return true;

}