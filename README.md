**Escape room - Grupo 4**

*INTEGRANTES*
  Unai, Ibai, Mikel, Ander, ~~Andrés~~

  *TEMÁTICA*
  Energias Renovables

  *TECNOLOGÍAS*
  Laravel, Vue, TailwindCss

  --Pasos a ejecutar para el despliegue--

  .env
  
      APP_KEY=base64:XJqhlUgWdCPw2iHLT5NyDoZuQjBAuY06zpFDLQXB6kU=
  
      VITE_APP_URL="${APP_URL}"
      
      APP_URL= your_route_to_public example: http://localhost/G4-2DW3A/scape_room_energia/

  comandos:
  
      npm install
    
      npm run build
    
      composer update
    
      composer install
    
      php artisan migrate:fresh --seed


