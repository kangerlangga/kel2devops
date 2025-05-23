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
                bat 'composer dump-autoload'
            }
        }

        stage('Prepare Environment File') {
            steps {
                bat 'IF NOT EXIST .env.testing copy .env.testing.example .env.testing'
            }
        }

        stage('Clear Caches') {
            steps {
                bat 'php artisan config:clear'
                bat 'php artisan route:clear'
                bat 'php artisan view:clear'
                bat 'php artisan cache:clear'
            }
        }

        stage('Generate App Key') {
            steps {
                bat 'php artisan key:generate --env=testing'
            }
        }

        stage('Prepare Database') {
            steps {
                bat 'php artisan migrate:fresh --env=testing --force'
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
