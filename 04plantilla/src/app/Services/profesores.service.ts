import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

import { IProfesor } from '../Interfaces/iprofeor'; // Asegúrate de que la interfaz esté correctamente definida
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProfesoresService {
  apiurl = 'http://localhost/school/escuela/controllers/profesores.controller.php?op=';
  
  constructor(private lector: HttpClient) {}

  buscar(texto: string): Observable<IProfesor> {
    const formData = new FormData();
    formData.append('texto', texto);
    return this.lector.post<IProfesor>(this.apiurl + 'uno', formData);
  }

  todos(): Observable<IProfesor[]> {
    return this.lector.get<IProfesor[]>(this.apiurl + 'todos');
  }

  uno(profesor_id: number): Observable<IProfesor> {
    const formData = new FormData();
    formData.append('profesor_id', profesor_id.toString());
    return this.lector.post<IProfesor>(this.apiurl + 'uno', formData);
  }

  eliminar(profesor_id: number): Observable<number> {
    const formData = new FormData();
    formData.append('profesor_id', profesor_id.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(profesor: IProfesor): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', profesor.nombre);
    formData.append('apellido', profesor.apellido);
    formData.append('especialidad', profesor.especialidad);
    formData.append('email', profesor.email);
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(profesor: IProfesor): Observable<string> {
    const formData = new FormData();
    formData.append('profesor_id', profesor.profesor_id.toString());
    formData.append('nombre', profesor.nombre);
    formData.append('apellido', profesor.apellido);
    formData.append('especialidad', profesor.especialidad);
    formData.append('email', profesor.email);
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}
