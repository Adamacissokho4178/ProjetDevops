pipeline { 
    agent any

    stages {
        stage('Cloner le code') {
            steps {
                // Spécifiez la branche "main"
                git branch: 'main', url: 'https://github.com/Adamacissokho4178/ProjetDevops.git'
            }
        }
    }

    post {
        success {
            echo '🎉 Clonage réussi !'
        }
        failure {
            echo '⚠️ Erreur lors du clonage, vérifiez les logs.'
        }
    }
}
