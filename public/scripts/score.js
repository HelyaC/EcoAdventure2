        let score = document.getElementById('score');
        let scoreValue = parseInt(score.textContent);
        function delayLoop(i) {
            if (i <= scoreValue) { 
                score.textContent = i; 
                setTimeout(() => delayLoop(i + 1), 25); 
            }
        }
        delayLoop(0);