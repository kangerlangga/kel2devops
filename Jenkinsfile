pipeline {
    agent any

    environment {
        APP_ENV = 'testing'
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Install Dependencies') {
            steps {
                bat 'composer install --no-interaction --prefer-dist'
            }
        }

        stage('Prepare Environment File') {
            steps {
                bat 'IF NOT EXIST .env.testing copy .env.testing.example .env.testing'
            }
        }

        stage('Generate App Key') {
            steps {
                bat 'php artisan key:generate --env=testing'
            }
        }

        stage('Prepare Database (Testing Only)') {
            steps {
                bat 'php artisan migrate --env=testing --force'
            }
        }

        stage('Run Tests') {
            steps {
                bat 'php artisan test --env=testing'
            }
        }
    }

    post {
        success {
            echo '✅ Build and test successful on Windows!'
        }
        failure {
            echo '❌ Build failed. Check console output for details.'
        }
    }
}
