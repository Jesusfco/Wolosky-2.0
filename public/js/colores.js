function ifExists(content,contentToFind) { 

	//Find in the string
	var result = result = (content.indexOf(contentToFind) > -1) ? true : false;
	return result;
}

function findContent() { 

	var content = document;
	if(ifExists(content,"inicio1234")) {

		alert("holi");
	} else { 
		alert("sorry");

	}

};