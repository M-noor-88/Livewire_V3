# ✅🗨️ To-Do & Real-Time Chat App

A Laravel + Livewire application that combines **task management** with a **real-time private chat system**.  
Built with **Breeze authentication**, **Tailwind CSS**, and **Pusher** for realtime events.

---

## ✨ Features

### 📝 To-Do
- CRUD operations for tasks
- Download tasks as **PDF**
- **Policy-based authorization** (users can only update their own tasks)
- Multi-language support (**English & Arabic**)

### 💬 Chat
- **Private 1:1 messaging** with Pusher
- Real-time events:
  - `MessageSent` → instant delivery
  - `UserTyping` → typing indicator
- **Online & Last Seen** status
- List users with their chat status

### 🔐 Auth & UI
- Authentication via **Laravel Breeze**
- Styled with **Tailwind CSS**
- Built with **Laravel 11 + Livewire**

---

## ⚡ Tech Stack
- Laravel 11  
- Livewire  
- Breeze (auth scaffolding)  
- Tailwind CSS  
- Pusher + Laravel Echo  

---

## 📸 Screenshots

### chat
 <img width="1896" height="885" alt="1" src="https://github.com/user-attachments/assets/c7441cdc-b722-434f-a070-d06920a86a2a" />


### Tasks & Multi languages
<img width="1918" height="821" alt="2" src="https://github.com/user-attachments/assets/ace1c847-d5cc-41e7-8139-e5754eef4fdc" />


### Tasks (PDF Export + CRUD)
<img width="1881" height="687" alt="3" src="https://github.com/user-attachments/assets/df32fb8e-3261-410f-829c-9a0288d7b462" />

### Create Task
<img width="1880" height="722" alt="4" src="https://github.com/user-attachments/assets/a277356e-5f3a-4ffb-9df9-9b88fa27ff91" />



## 🚀 Setup

```bash
# Clone and install
git clone https://github.com/M-noor-88/Livewire_V3.git
cd todo-chat-app
composer install
npm install && npm run dev

# Configure environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Start the app
php artisan serve
npm run dev
