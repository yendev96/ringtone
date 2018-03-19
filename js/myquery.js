	function getDuration(src, cb) {
		var audio = new Audio();
		$(audio).on("loadedmetadata", function(){
			cb(audio.duration);
		});
		audio.src = src;
	}
	

	function bytesToSize(bytes) {
		var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
		if (bytes == 0) return '0 Byte';
		var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
		return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
	};

	function get_filesize(url, callback) {
		var xhr = new XMLHttpRequest();
		xhr.open("HEAD", url, true);
		xhr.onreadystatechange = function() {
			if (this.readyState == this.DONE) {
				callback(parseInt(xhr.getResponseHeader("Content-Length")));
			}
		};

		xhr.send();
	}
	
