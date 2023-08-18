<template>
    <div class="error-container">
      <div class="error-code">404</div>
      <div class="error-message">Oops! The page you're looking for could not be found.</div>
      <RouterLink to="/" class="home-link btn btn-success mt-3">Go to Homepage</RouterLink>
    </div>
  </template>
  
  <style scoped>
  .error-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    text-align: center;
  }
  
  .error-code {
    font-size: 120px;
    font-weight: bold;
    color: #27374D; /* Bootstrap's danger color */
  }
  
  .error-message {
    font-size: 24px;
    margin-top: 20px;
    color: #27374D; /* Bootstrap's danger color */
  }
  
  .home-link {
    margin-top: 30px;
    
  }
  </style>
  