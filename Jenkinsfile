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

        stage('Run Authentication Tests Only') {
            steps {
                bat 'php artisan test --filter=AuthenticationTest --env=testing'
            }
        }
    }

    post {
        success {
            echo '✅ Authentication tests passed!'
        }
        failure {
            echo '❌ Authentication test failed. Check console output for details.'
        }
    }
}
