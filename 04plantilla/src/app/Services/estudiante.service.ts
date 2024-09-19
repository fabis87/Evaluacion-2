import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

import { IEstudiante } from '../Interfaces/iestudiante';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class EstudiantesService {
  apiurl = 'http://localhost/school/escuela/controllers/estudiantes.controller.php?op=';
  constructor(private lector: HttpClient) {}

  buscar(texto: string): Observable<IEstudiante> {
    const formData = new FormData();
    formData.append('texto', texto);
    return this.lector.post<IEstudiante>(this.apiurl + 'uno', formData);
  }

  todos(): Observable<IEstudiante[]> {
    return this.lector.get<IEstudiante[]>(this.apiurl + 'todos');
  }

  uno(estudiante_id: number): Observable<IEstudiante> {
    const formData = new FormData();
    formData.append('estudiante_id', estudiante_id.toString());
    return this.lector.post<IEstudiante>(this.apiurl + 'uno', formData);
  }

  eliminar(estudiante_id: number): Observable<number> {
    const formData = new FormData();
    formData.append('estudiante_id', estudiante_id.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(estudiante: IEstudiante): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', estudiante.nombre);
    formData.append('apellido', estudiante.apellido);
    formData.append('fecha_nacimiento', estudiante.fecha_nacimiento);
    formData.append('grado', estudiante.grado);
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(estudiante: IEstudiante): Observable<string> {
    const formData = new FormData();
    formData.append('estudiante_id', estudiante.estudiante_id.toString());
    formData.append('nombre', estudiante.nombre);
    formData.append('apellido', estudiante.apellido);
    formData.append('fecha_nacimiento', estudiante.fecha_nacimiento);
    formData.append('grado', estudiante.grado);
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}
