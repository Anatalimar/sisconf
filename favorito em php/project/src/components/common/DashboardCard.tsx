import { ReactNode } from 'react';
import { DivideIcon as LucideIcon } from 'lucide-react';

interface DashboardCardProps {
  title: string;
  value: string | number;
  icon: LucideIcon;
  color: 'primary' | 'success' | 'warning' | 'danger' | 'secondary';
  change?: {
    value: number;
    isPositive: boolean;
  };
}

const DashboardCard = ({ title, value, icon: Icon, color, change }: DashboardCardProps) => {
  const getColorClasses = () => {
    switch (color) {
      case 'primary':
        return 'bg-primary-50 text-primary';
      case 'success':
        return 'bg-success-100 text-success';
      case 'warning':
        return 'bg-warning-100 text-warning';
      case 'danger':
        return 'bg-danger-100 text-danger';
      case 'secondary':
        return 'bg-secondary-50 text-secondary';
      default:
        return 'bg-primary-50 text-primary';
    }
  };

  return (
    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
      <div className="flex justify-between items-start">
        <div>
          <h3 className="text-gray-500 text-sm font-medium">{title}</h3>
          <p className="text-2xl font-bold mt-1 text-gray-800">{value}</p>
          
          {change && (
            <div className={`flex items-center mt-2 text-xs font-medium ${change.isPositive ? 'text-success' : 'text-danger'}`}>
              <span>{change.isPositive ? '+' : ''}{change.value}%</span>
              <span className="ml-1">desde o último mês</span>
            </div>
          )}
        </div>
        
        <div className={`p-3 rounded-full ${getColorClasses()}`}>
          <Icon size={20} />
        </div>
      </div>
    </div>
  );
};

export default DashboardCard;