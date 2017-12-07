 (function() {

  var httpRequest;

  document.getElementById("submit-note").onclick = function() {
    var formData = new FormData();
    formData.append("noteTitle", document.getElementById('note-title').value);
    formData.append("noteText", document.getElementById('note-text').value);
    sendHttpRequest('POST', 'validate.php', formData, handleValidateResponse);
  };

  function handleValidateResponse() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        var response = JSON.parse(httpRequest.response);
        if (response.errors) {
          var errorString = '';
          Array.prototype.forEach.call(response.errors, function(errorMsg, i){
            errorString += errorMsg + "\n";
          });
          alert(errorString);
          return false;
        }

        var formData = new FormData();
        formData.append("noteTitle", response.noteTitle);
        formData.append("noteText", response.noteText);
        sendHttpRequest('POST', 'api.php', formData);
        return true;
      } else {
        alert('There was a problem with the request.');
      }
    }
    return false;
  }

  function sendHttpRequest(method, url, formData, handleResponseMethod) {
    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
        alert('Giving up :( Cannot create an XMLHTTP instance');
        return false;
    }

    if (handleResponseMethod) {
        httpRequest.onreadystatechange = handleResponseMethod;
    }

    httpRequest.open(method, url);

    httpRequest.send(formData);
  }
})();