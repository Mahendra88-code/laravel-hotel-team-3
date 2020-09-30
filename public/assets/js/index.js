function google_login() {
	var provider = new firebase.auth.GoogleAuthProvider();
	firebase.auth().signInWithPopup(provider).then(function(result) {
		var token = result.credential.accessToken;
		var users = result.user;
		console.log(token);
		console.log(users);

		Swal.fire({
			icon: 'success',
			title: "Success!",
			text: "Your Google Account has been linked"
		})
		
	}).catch(function(error) {
		var errorCode = error.code;
		var errorMessage = error.message;
		var email = error.email;
		var credential = error.credential;
		Swal.fire({
			icon: 'success',
			title: "Failure!",
			text: "Your Google Account Unlinked"
		})
	});
}