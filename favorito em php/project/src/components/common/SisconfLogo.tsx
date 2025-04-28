import { Database } from 'lucide-react';

interface SisconfLogoProps {
  size?: 'small' | 'medium' | 'large';
}

const SisconfLogo = ({ size = 'medium' }: SisconfLogoProps) => {
  let dimensions;
  
  switch (size) {
    case 'small':
      dimensions = { width: 24, height: 24 };
      break;
    case 'large':
      dimensions = { width: 42, height: 42 };
      break;
    case 'medium':
    default:
      dimensions = { width: 32, height: 32 };
      break;
  }
  
  return (
    <div className="flex items-center justify-center bg-primary rounded-md p-1 text-white">
      <Database {...dimensions} />
    </div>
  );
};

export default SisconfLogo;