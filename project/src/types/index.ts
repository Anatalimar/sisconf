export interface Attendee {
  name: string;
  email: string;
  department: string;
  type: 'server' | 'intern' | 'companion' | 'child';
  childAge?: number;
  willAttend: boolean;
}